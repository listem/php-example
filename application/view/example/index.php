<link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
<style tyle="text/css">
body {
    zoom: 75%;
}
</style>
<!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
<div class="navbar-header navbar-brand">
  Learning Management System
</div>
</nav> -->
<div class="container-fluid pt-3">
    <div class="container-fluid">
        <h2>Course Units</h2>

        <?php if(isset($filters)): ?>
        <hr />
        <form method="GET" class="form-horizontal row" action="/example/after">
            <?php 
            foreach($filters as $filter): 
                $filter = new Listem\Html\Decorators\Bootstrap($filter);
            ?>
                <div class="form-group col-sm-6">
                    <div class="row">
                        <?php echo $filter->renderLabel() ?>
                        <?php echo $filter->renderFormElem() ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="form-group col-sm-12">
                <button class="btn btn-primary" type="submit">Filter</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </form>
        <?php endif ?>
        
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Credits</th>
                <th>Active</th>
                <th>Course Name</th>
                <th>Lecturer Name</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($units as $unit) { ?>
                <tr>
                    <td><?php if (isset($unit->unit_name)) echo htmlspecialchars($unit->unit_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($unit->unit_code)) echo htmlspecialchars($unit->unit_code, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($unit->credits)) echo htmlspecialchars($unit->credits, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($unit->unit_active)) echo htmlspecialchars(($unit->unit_active === '1' ? 'Yes': 'No'), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($unit->course_name)) echo htmlspecialchars($unit->course_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($unit->lecturer_name)) echo htmlspecialchars($unit->lecturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>