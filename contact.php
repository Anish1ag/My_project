<?php include('header.php'); ?>

      <!--contact file -->
      <section class ="contact">
        <div class="container">
            <h2 class="text-center contact-heading">Send us a message </h2>
            <form action="" class="form-horizontal">
                <label for="" >Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">

                <label for=""><br>Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="Enter your email">

                <label for="">Message</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Enter the message"></textarea>
                <button class="btn btn-primary">Submit </button>
            </form>
        </div>
      </section>
    
     
      <?php include('footer.php'); ?>