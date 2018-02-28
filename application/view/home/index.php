<div class="container">
    <h2>Units</h2>
    <!-- main content output -->
    <div class="box">
        <h3>List of units</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Code</td>
                <td>Credits</td>
                <td>Active</td>
                <td>CourseName</td>
                <td>LecturerName</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($units as $unit) { ?>
                <tr>
                    <td><?php if (isset($unit->id)) echo htmlspecialchars($unit->id, ENT_QUOTES, 'UTF-8'); ?></td>
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