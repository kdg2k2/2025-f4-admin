const notify = (message, hexCodeBackgroundColor) => {
    $.notify(message, {
        align: "right",
        verticalAlign: "top",
        color: "#fff",
        background: hexCodeBackgroundColor,
        animationType: "drop",
    });
};

const alertErr =(message)=>{
    notify(message, "#dc3545");
}

const alertSuccess=(message)=>{
    notify(message, "#1cc88a");
}