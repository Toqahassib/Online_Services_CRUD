<?php include('partials-front/menu.php'); 

include "./config/constants.php";


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {  

            //check whether service id is saved or not
            if(isset($_GET['service_id']))
            {
                //get the service id and details of the selected service
                $service_id = $_GET['service_id'];

                //get the details of the selected service
                $sql = "SELECT * FROM tbl_services WHERE id=$service_id";

                //executr the query
                $res = mysqli_query($conn, $sql);

                //count the rows
                $count = mysqli_num_rows($res);

                //check whether the data is available or not
                // we are equaling it to 1 because only 1 service shoyld be selected
                if($count==1)
                {
                    //we have data
                    //get data from dayabase
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                }
                else
                {
                    //service not available
                    //redirect to home pg
                    header('location:'.SITEURL.'home.php');
                }
            }
            else
            {
                //redirect to homepage
                header('location:'.SITEURL.'home.php');
            }
        ?>

        <!-- service sEARCH Section Starts Here -->
        <section class="service-search">
            <div class="container">
                
                <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

                <form action="" method="POST" class="order">
                    <fieldset>
                        <legend>Selected Service</legend>

                        <div class="service-menu-img">

                            <?php
                                //check whether the image is available or not
                                if($image_name=="")
                                {
                                    //image not availabel
                                    echo "<div class='error'>image not available.</div>";
                                }
                                else
                                {
                                    //image availalble
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>
        
                        <div class="service-menu-desc">
                            <h3><?php echo $title ?></h3>
                            <input type="hidden" name="service" value="<?php echo $title ?>">
                            <p class="service-price">$<?php echo $price ?></p>
                            <input type="hidden" name="price" value="<?php echo $price ?>">


                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" value="1" required>
                            
                        </div>

                    </fieldset>
                    
                    <fieldset>
                        <legend>Delivery Details</legend>
                        <div class="order-label">Full Name</div>
                        <input type="text" name="full-name" placeholder="Test User" class="input-responsive" required>

                        <div class="order-label">Phone Number</div>
                        <input type="tel" name="contact" placeholder="0123xxxxxx" class="input-responsive" required>

                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="test@gmail.com" class="input-responsive" required>

                        <div class="order-label">Address</div>
                        <textarea name="address" rows="10" placeholder="Street, City, Country" class="input-responsive" required></textarea>

                        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    </fieldset>

                </form>

                <?php
                    //check whethe rsubmit button is clicked or not
                    if(isset($_POST['submit']))
                    {
                        //get all the details from the form

                        $service = mysqli_real_escape_string($conn, $_POST['service']);
                        $price = mysqli_real_escape_string($conn,$_POST['price']);
                        $qty = mysqli_real_escape_string($conn,$_POST['qty']);

                        $total = mysqli_real_escape_string($conn,$price * $qty);

                        $order_date = mysqli_real_escape_string($conn, date("Y-m-d h:i:sa"));

                        $status = mysqli_real_escape_string($conn,"Ordered"); //ordered, on delivery, delivered, cancelled

                        $customer_name = mysqli_real_escape_string($conn,$_POST['full-name']);
                        $customer_contact = mysqli_real_escape_string($conn,$_POST['contact']);
                        $customer_email = mysqli_real_escape_string($conn,$_POST['email']);
                        $customer_address = mysqli_real_escape_string($conn,$_POST['address']);

                        //save the order in database
                        //create sql to save the data
                        $sql2="INSERT INTO tbl_order SET
                            service = '$service',
                            price = $price,
                            qty = $qty,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'

                        ";

                        // echo $sql2; die();

                        //execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        //check whether the query is executed successfully or not
                        if($res2==true)
                        {
                            //query executed successfuly and order is saved
                            $_SESSION['order'] = "<div class = 'success text-center'>Service ordered successfully</div>";
                            header('location:'.SITEURL.'home.php');
                        }
                        else
                        {
                            //failed to save order
                            $_SESSION['order'] = "<div class = 'error text-center'>Failed to order Service</div>";
                            header('location:'.SITEURL.'home.php');
                        }

                    }
                    else
                    {

                    }
                ?>

            </div>
        </section>
        <!-- service sEARCH Section Ends Here -->

        <?php include('partials-front/footer.php'); ?>


    </body>
    </html>
<?php
}else
{
    header("location: login2.php");
    exit();
}
?>