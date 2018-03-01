<div class="container-fluid pt-3">
    <h2>Course Units</h2>
    <div class="container-fluid">
        <h3>List of units</h3>
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