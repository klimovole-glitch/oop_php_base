<?php

interface Reportable {
    public function generate(): string;
}

abstract class StudentBase {
    public function __construct(protected string $name, protected string $group) {}
}

class AverageReport extends StudentBase implements Reportable {
    public function __construct(string $name, string $group, private array $grades) {
        parent::__construct($name, $group);
    }

    public function generate(): string {
        $avg = array_sum($this->grades) / count($this->grades);
        return "<tr><td>{$this->name}</td><td>{$this->group}</td><td>Успеваемость</td><td>Ср. балл: " . round($avg, 2) . "</td></tr>";
    }
}

class AttendanceReport extends StudentBase implements Reportable {
    public function __construct(string $name, string $group, private int $missed) {
        parent::__construct($name, $group);
    }

    public function generate(): string {
        return "<tr><td>{$this->name}</td><td>{$this->group}</td><td>Посещаемость</td><td>Пропусков: {$this->missed}</td></tr>";
    }
}

$reports = [
    new AverageReport("Репенко Ярослав Андреевич", "ИСП-341", [5, 4, 5, 3, 5]),
    new AttendanceReport("Репенко Ярослав Андреевич", "ИСП-341", 2),
    new AverageReport("Смирнова Анна Сергеевна", "ИСП-341", [4, 4, 5, 4, 5]),
    new AttendanceReport("Смирнова Анна Сергеевна", "ИСП-341", 0),
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Журнал ИСП-341</title>
    <style>
        body { font-family: sans-serif; background: #e0e0e0; padding: 40px; margin: 0; }
        .journal { max-width: 900px; margin: 0 auto; background: #fff; padding: 30px; border: 2px solid #000; }
        h1 { text-align: center; font-size: 20px; text-transform: uppercase; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background: #000; color: #fff; }
    </style>
</head>
<body>
    <div class="journal">
        <h1>Ведомость группы ИСП-341</h1>
        <table>
            <thead>
                <tr>
                    <th>Студент</th>
                    <th>Группа</th>
                    <th>Тип отчета</th>
                    <th>Показатель</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($reports as $report) {
                    echo $report->generate();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>