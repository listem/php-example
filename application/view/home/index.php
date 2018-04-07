<link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">

<!-- <div class="container-fluid pt-3"> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">
            Listem - Interactive Demos <span class="sr-only">(current)</span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav justify-content-end">
      <li class="nav-item" style="margin-right: 10px;">
        <a class="nav-link" href="https://github.com/listem/listem-php" target="_blank"><i class="fab fa-github"></i> Find us on Github</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <select class="form-control mr-sm-2 custom-select custom-select-sm">
        <option>Basic Demo (Pure PHP implementation)</option>
        <option>Laravel</option>
      </select>
    </form>
  </div>
    <!-- <div style="padding: 0px;">
        <h3>Listem Interactive Demo</h3>
        <p class="lead small">Play around with the demo windows below and view the diff of how easily the filters were achieved!</p>
        <hr />
    </div> -->
</nav>
<!-- </div> -->

<div class="container-fluid pt-3">
    <div class="row" style="height: 85vh; overflow: auto; text-align: center; position: relative; background: ">
        <div  style="position: absolute; width: 20%; top: 0px; left: 40%;">
            <small><a href="#" data-toggle="modal" data-target="#diffModal"><i class="fas fa-code"></i> View Diff</a></small>
        </div>
        <div class="w-50 h-100 d-inline-block" style="padding: 10px 15px; padding-right: 7px;">
            <small class="text-muted" style="display: block; padding-bottom: 10px;">Before</small>
            <iframe class="w-100 h-100" src="/example" style="border: 2px solid #eee;"></iframe>
        </div>
        <div class="w-50 h-100 d-inline-block" style="padding: 10px 15px; padding-left: 7px;">
            <small class="text-muted" style="display: block; padding-bottom: 10px;">After</small>
            <iframe class="w-100 h-100" src="/example/after" style="border: 2px solid #eee;"></iframe>
        </div>
    </div>
</div>

<div class="modal fade" id="diffModal" tabindex="-1" role="dialog" aria-labelledby="diffModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Changes Made</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h7>composer.json</h7>
        <pre><code class="diff">
  "require": {
      "php": ">=5.3.0",
+     "listem/listem-php": "^1.0"
  }
        </code></pre>
        <h7>Controller</h7>
        <pre><code class="diff">
+ $config = [
+     'filters' => [
+         'u.name' => ['label' => 'Unit Name'],
+         'u.code' => ['label' => 'Unit Code'],
+         'u.active' => [
+             'label' => 'State',
+             'type' => Listem\Filter::ENUM_INPUT,
+             'enums' => [
+                 1 => 'Active',
+                 0 => 'Draft'
+             ]
+         ],
+         'created_at' => ['label' => 'Created On', 'type' => Listem\Filter::DATE],
+         'u.course_id' => ['label' => 'Course Name', 'type' => Listem\Filter::ENUM_SELECT],
+         'u.lecturer_id' => ['label' => 'Lecturer Name', 'type' => Listem\Filter::ENUM_SELECT]
+     ]
+ ];
 
+ $list = new Listem\ListEntity(
+     $config, 
+     new Listem\Conditions\Database\Drivers\MySQL, 
+     new Listem\Parameter\QueryString
+ );
 
+ $filters = $list->getFilters();

+ // Get filter conditions 
+ $filterConditions = $filters->getConditions();
 
+ // If no conditions are set, use default condition
+ $filterConditions = ($filterConditions) ? : 1;

  // Get all units from DB
  $query = &lt;&lt;&lt;SQL
  SELECT *, u.name AS unit_name, u.code AS unit_code, u.credits, u.active AS unit_active, c.name AS course_name, l.name AS lecturer_name   
        FROM units u
        JOIN courses c ON u.course_id = c.id
        JOIN lecturers l ON u.lecturer_id = l.id
+       WHERE {$filterConditions}
  SQL;

+ $courses = $this->getCoursesList();
+ $lecturers = $this->getLecturersList();

+ // Set 'Course' filter's dropdown values 
+ $filters->getFilter('u.course_id')
+     ->setEnums($courses, 'All Courses');

+ // Set 'Lecturer' filter's dropdown values  
+ $filters->getFilter('u.lecturer_id')
+     ->setEnums($lecturers, 'All Lecturers');
 
 $units = $this->model->fetchAll($query);
 
 // Load views
 ...
        </code></pre>

                <h7>View</h7>
        <pre><code class="diff">
+ &lt;form method=&quot;GET&quot; class=&quot;form-horizontal row&quot; action=&quot;/example/after&quot;&gt;
+     &lt;?php 
+     foreach($filters as $filter): 
+         $filter = new Listem\Html\Decorators\Bootstrap($filter);
+     ?&gt;
+         &lt;div class=&quot;form-group col-sm-6&quot;&gt;
+             &lt;div class=&quot;row&quot;&gt;
+                 &lt;?php echo $filter-&gt;renderLabel() ?&gt;
+                 &lt;?php echo $filter-&gt;renderFormElem() ?&gt;
+             &lt;/div&gt;
+         &lt;/div&gt;
+     &lt;?php endforeach; ?&gt;
+     &lt;div class=&quot;form-group col-sm-12&quot;&gt;
+         &lt;button class=&quot;btn btn-primary&quot; type=&quot;submit&quot;&gt;Filter&lt;/button&gt;
+         &lt;button class=&quot;btn btn-link&quot; type=&quot;reset&quot;&gt;Reset&lt;/button&gt;
+     &lt;/div&gt;
+ &lt;/form&gt;
        </code></pre>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css"> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<link rel="stylesheet" href="/css/highlight.min.css">
<script>hljs.initHighlightingOnLoad();</script>