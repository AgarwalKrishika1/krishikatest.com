<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Feedbacks</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Message</th>
              <th>Ratting</th>
            </tr>
          </thead>
          <tbody id="customer_feedback">
           
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>