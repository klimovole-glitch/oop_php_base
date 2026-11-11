<?php

class Student {
    public function __construct(private string $name, private string $group) {}

    public function getName(): string {
        return $this->name;
    }
    public function getGroup(): string {
        return $this->group;
    }
}

class Subject {
    public function __construct(private string $title) {}

    public function getTitle(): string {
        return $this->title;
    }
}

class Grade {
    private int $value;

    public function __construct(int $value) {
        if ($value < 2 || $value > 5) {
            throw new Exception("Оценка должна быть от 2 до 5!");
        }
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value;
    }
}

try {
    $student = new Student("Репенко Ярослав Андреевич", "ИСП-341");
    $subject = new Subject("Программирование в PHP");
    
    $grade1 = new Grade(5);
    $grade2 = new Grade(4);

    echo "<h2>Базовая модель</h2>";
    echo "Студент: " . $student->getName() . "<br>";
    echo "Группа: " . $student->getGroup() . "<br>";
    echo "Предмет: " . $subject->getTitle() . "<br>";
    echo "Оценки: " . $grade1->getValue() . ", " . $grade2->getValue() . "<br>";

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>