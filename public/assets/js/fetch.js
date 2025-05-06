let controller = null;
let isRefreshing = false;
let refreshPromise = null;
let requestQueue = [];

const unloadHandler = () => {
    if (controller) {
        controller.abort();
    }
};
window.addEventListener("unload", unloadHandler);

const makeHttpRequest = (method = "get", url, params = {}, csrfToken = "") => {
    return new Promise((resolve, reject) => {
        method = method.toLowerCase();
        if (!["get", "post"].includes(method)) {
            return reject(new Error("Method chỉ hỗ trợ GET hoặc POST"));
        }

        controller = new AbortController();
        const { signal } = controller;

        showLoading();

        const fetchOptions = {
            method: method.toUpperCase(),
            redirect: "manual",
            credentials: "include", // include cookies in request
            signal,
        };

        let fetchUrl = url;

        if (method === "post") {
            // handle file upload vs JSON
            if (params instanceof FormData) {
                params.append("_token", csrfToken);
                fetchOptions.headers = {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": csrfToken,
                };
                fetchOptions.body = params;
            } else {
                const body = { ...params, _token: csrfToken };
                fetchOptions.headers = { "Content-Type": "application/json" };
                fetchOptions.body = JSON.stringify(body);
            }
        } else if (Object.keys(params).length) {
            const qp = new URLSearchParams(params).toString();
            fetchUrl = `${url}?${qp}`;
        }

        fetch(fetchUrl, fetchOptions)
            .then(async (response) => {
                if (
                    response.type === "opaqueredirect" ||
                    response.status === 302
                ) {
                    throw {
                        status: response.status,
                        message: "Không có quyền truy cập!",
                    };
                }

                if (response.status >= 500) {
                    throw {
                        status: response.status,
                        message: response.statusText,
                    };
                }

                const contentType = response.headers.get("content-type") || "";
                const isJson = contentType.includes("application/json");
                const data = isJson
                    ? await response.json()
                    : await response.text();

                if (!response.ok) {
                    const msg = data.message || data;
                    if (data.errors)
                        msg = Object.values(data.errors).flat().join(" - ");
                    alertErr(msg);
                    throw { status: response.status, data };
                }

                return data;
            })
            .then((data) => {
                resolve(data);
            })
            .catch((err) => {
                if (err.name === "AbortError") {
                    console.warn("Request aborted");
                    return;
                }
                console.error("Fetch error:", err);
                reject(err);
            })
            .finally(hideLoading);
    });
};

const apiRequest = async (method, url, params = {}, csrfToken = "") => {
    try {
        return await makeHttpRequest(method, url, params, csrfToken);
    } catch (err) {
        if (err.status === 401) {
            if (!isRefreshing) {
                isRefreshing = true;
                refreshPromise = makeHttpRequest(
                    "post",
                    "/api/auth/refresh",
                    {},
                    csrfToken
                )
                    .then(() => {
                        isRefreshing = false;
                        // Retry all queued requests
                        requestQueue.forEach((cb) => cb.resolve());
                        requestQueue = [];
                    })
                    .catch((refreshErr) => {
                        isRefreshing = false;
                        requestQueue.forEach((cb) => cb.reject(refreshErr));
                        requestQueue = [];
                        window.location.href = "/login";
                        throw refreshErr;
                    });
            }

            return new Promise((resolve, reject) => {
                requestQueue.push({
                    resolve: async () => {
                        try {
                            const data = await makeHttpRequest(
                                method,
                                url,
                                params,
                                csrfToken
                            );
                            resolve(data);
                        } catch (retryErr) {
                            reject(retryErr);
                        }
                    },
                    reject,
                });
            });
        }

        throw err;
    }
};

class HttpIntant {
    async get(url, data, csrfToken) {
        return apiRequest("GET", url, data, csrfToken);
    }
    async post(url, data, csrfToken) {
        return apiRequest("POST", url, data, csrfToken);
    }
    async put(url, data, csrfToken) {
        if (data instanceof FormData) {
            data.append("_method", "PUT");
        } else {
            data = { ...data, _method: "PUT" };
        }
        return apiRequest("POST", url, data, csrfToken);
    }
    async delete(url, data, csrfToken) {
        if (data instanceof FormData) {
            data.append("_method", "DELETE");
        } else {
            data = { ...data, _method: "DELETE" };
        }
        return apiRequest("POST", url, data, csrfToken);
    }
    async patch(url, data, csrfToken) {
        if (data instanceof FormData) {
            data.append("_method", "PATCH");
        } else {
            data = { ...data, _method: "PATCH" };
        }
        return apiRequest("POST", url, data, csrfToken);
    }
}
const http = new HttpIntant();
