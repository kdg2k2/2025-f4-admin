<?php

namespace App\Services;

use Carbon\Carbon;

class DashboardService extends BaseService
{
    protected $orderService;
    public function __construct()
    {
        $this->orderService = app(OrderService::class);
    }

    public function loadRevenueData(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $converts = [
                'success' => [
                    'title' => 'Giao dịch thành công',
                    'color' => '#3ad6a1'
                ],
                'failed' => [
                    'title' => 'Giao dịch thất bại',
                    'color' => '#ff585d'
                ],
                'pending' => [
                    'title' => 'Giao dịch đang thực hiện',
                    'color' => '#f9d8af'
                ],
            ];
            $days = $this->getWeekday(date('Y-m-d'));
            $from = $request['from'] ?? $days[0];
            $to = $request['to'] ?? $days[6];
            $orders = $this->orderService->list([
                'paginate' => 0,
                'from' => $from,
                'to' => $to,
            ]);
            $res = [];
            $res['from'] = $from;
            $res['to'] = $to;

            // Doanh thu theo tuần
            $payments = array_merge(...array_filter(array_column($orders, 'payments'), fn($item) => !empty($item)));
            $groupPayments = collect($payments);

            $res['revenue'] = $groupPayments->groupBy('status')->map(function ($paymentsByStatus) use ($days, $converts) {
                $convert = $converts[$paymentsByStatus[0]['status']];

                $groupedByDay = $paymentsByStatus->groupBy(function ($payment) {
                    return date('Y-m-d', strtotime($payment['created_at']));
                });

                $newDays = collect($days)->map(function ($day) use ($groupedByDay) {
                    $totalForDay = $groupedByDay->get($day, collect())->sum('vnp_Amount');
                    return [
                        'day' => $day,
                        'sum' => $totalForDay,
                    ];
                })->toArray();

                return [
                    'color' => $convert['color'],
                    'title' => $convert['title'],
                    'days' => $newDays,
                    'sum' => $paymentsByStatus->sum('vnp_Amount'),
                ];
            })->toArray();

            $res['revenue']['total'] = [
                'color' => '#308e87',
                'title' => 'Tổng tiền giao dịch',
                'sum' => $groupPayments->sum('vnp_Amount'),
                'days' => collect($days)->map(function ($day) use ($groupPayments) {
                    $totalForDay = $groupPayments->filter(function ($payment) use ($day) {
                        return date('Y-m-d', strtotime($payment['created_at'])) == $day;
                    })->sum('vnp_Amount');

                    return [
                        'day' => $day,
                        'sum' => $totalForDay,
                    ];
                })->toArray(),
            ];

            $res['revenue'] = array_reverse($res['revenue']);

            return $res;
        });
    }



    protected function getWeekday($today)
    {

        $today = Carbon::parse($today);

        $startOfWeek = $today->startOfWeek();
        $daysOfWeek = [];

        for ($i = 0; $i < 7; $i++)
            $daysOfWeek[] = $startOfWeek->copy()->addDays($i)->format('Y-m-d');

        return $daysOfWeek;
    }
}
