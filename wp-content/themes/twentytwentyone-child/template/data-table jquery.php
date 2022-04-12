<?php 
/**
 * Template Name:   data-table jquery
 * Template Post Type:post,page,my-post-type;
 */
get_header();
?>
<div class="container">
<table id="my-first-table" class="display" cellspacing="0" style="width:100%">
    <thead>
        <tr>
        <th>Page</th>
            <th>Date</th>
            <th>Medium</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>01/01/2020</td>
            <td>video</td>
        </tr>
        <tr>
            <td>2</td>
            <td>06/12/2020</td>
            <td>photo</td>
        </tr>
        <tr>
            <td>3</td>
            <td>07/03/2020</td>
            <td>newspaper</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Page</th>
            <th>Date</th>
            <th>Medium</th>
        </tr>
    </tfoot>
</table>
</div>



<div class="container" style="margin-top: 20px;">
<table id="table_id">
<thead>
<tr>
<th class="subj_name">Subject</th>
<th>Marks</th>
<th>Grade</th>
<th>Last Modified</th>
</tr>
</thead>
<tbody></tbody>
</table>
<script
type="text/javascript"
charset="utf8"
src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"
></script>
<script
type="text/javascript"
charset="utf8"
src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"
></script>
<script>
$(function() {
$("#table_id").dataTable({
aaData: [
["Maths", "95", "A+", "null"],
["English", "85", "A", "null"],
["Science", "70", "A+", "2019-06-11 06:30:00"],
["History", "80", "A", "null"],
["Arts", "75", "B", "null"],
["Economics", "70", "A+", "2019-11-09 06:30:00"],
["Commerce", "80", "A", "null"] ],
 });
});
</script>
</div>
<?php
get_footer();
?>