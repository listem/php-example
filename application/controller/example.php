<?php

/**
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Example extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $query = $sql = <<<SQL
            SELECT *, u.name AS unit_name, u.code AS unit_code, u.credits, u.active AS unit_active, c.name AS course_name, l.name AS lecturer_name   
            FROM units u
            JOIN courses c ON u.course_id = c.id
            JOIN lecturers l ON u.lecturer_id = l.id
SQL;

        $units = $this->model->fetchAll($query);

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/example/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function after()
    {
        $config = [
            'filters' => [
                'u.name' => ['label' => 'Unit Name'],
                'u.code' => ['label' => 'Unit Code'],
                'u.active' => [
                    'label' => 'State',
                    'type' => Listem\Filter\Filter::ENUM_INPUT,
                    'enums' => [
                        1 => 'Active',
                        0 => 'Draft'
                    ]
                ],
                'created_at' => ['label' => 'Created On', 'type' => Listem\Filter\Filter::DATE],
                'u.course_id' => ['label' => 'Course Name', 'type' => Listem\Filter\Filter::ENUM_SELECT],
                'u.lecturer_id' => ['label' => 'Lecturer Name', 'type' => Listem\Filter\Filter::ENUM_SELECT]
            ]
        ];

        $list = new Listem\ListEntity(
            $config, 
            new Listem\Conditions\Database\Drivers\MySQL, 
            new Listem\Parameter\QueryString
        );

        $filters = $list->getFilters();

        $filterConditions = $filters->getConditions();

        // If no conditions are set, use default condition
        $filterConditions = ($filterConditions) ? : 1;

        $query = $sql = <<<SQL
            SELECT *, u.name AS unit_name, u.code AS unit_code, u.credits, u.active AS unit_active, c.name AS course_name, l.name AS lecturer_name   
            FROM units u
            JOIN courses c ON u.course_id = c.id
            JOIN lecturers l ON u.lecturer_id = l.id
            WHERE {$filterConditions}
SQL;

        // echo $query; exit;
        $courses = $this->getCoursesList();
        $filters->getFilter('u.course_id')
            ->setEnums($courses, 'All Courses');

        $lecturers = $this->getLecturersList();
        $filters->getFilter('u.lecturer_id')
            ->setEnums($lecturers, 'All Lecturers');

        $units = $this->model->fetchAll($query);

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/example/index.php';
        require APP . 'view/_templates/footer.php';
    }

    protected function getCoursesList()
    {
        $query = "SELECT * FROM courses ORDER BY name";

        $courses = [];
        
        foreach ($this->model->fetchAll($query) as $course) {
            $courses[$course->id] = $course->name;
        }

        return $courses;
    }

    protected function getLecturersList()
    {
        $query = "SELECT * FROM lecturers ORDER BY name";

        $lecturers = [];
        
        foreach ($this->model->fetchAll($query) as $lecturer) {
            $lecturers[$lecturer->id] = $lecturer->name;
        }

        return $lecturers;
    }
}
