<?php
function get_unique_categories()
{
  global $con;
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $select_query = "Select * from `products` where category_id=$category_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<img src='./images/no_stock.gif' alt='' width='50' height='500'>";
      echo "<h2 class='text-center text-danger'>No stock for this category</h3>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $category_id = $row['category_id'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];

      echo "<div class='col-md-4 col-sm-6 mb-3'>
          <div class='card border border-dark h-100'>
            <img src='./admin_area/product_images/$product_image1' 
              class='card-img-top object-fit-contain p-2' alt='$product_title' width='100%' height='350px' >
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                  <p class='card-text'>$product_description</p>
                  <p class='card-text'>$product_price</p>
                <a href='home.php?add_to_cart=$product_id' 
                class='mbtn3 p-2 my-1'>Add to cart</a>
                <a href='product_details.php?product_id=$product_id' 
                class='mbtn3 p-2 my-1'>View More</a>
              </div>
          </div>
          </div>";
    }
  }
}

function search_product()
{
  global $con;
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];
    $search_query = "Select * from `products` where product_keywords like 
                   '%$search_data_value%'";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger' ><img src='images/search.gif'></h2>";
    }
    else{
      echo "<h6 class='text-center' ><img src='images/searchdone.gif' width='261' height='261'></h6>";
      echo "<h2 class='text-center text-dark mb-5 fw-lighter'>Search Successful... Here are your products<img src='images/down1.gif' width='50' height='100'></h2>";
      echo"<div='container d-flex justify-content-center'><div class='row d-flex justify-content-center'>";

    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $category_id = $row['category_id'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      
      echo "<div class='col-md-6 col-lg-3 col-xl-3 col-12 col-sm-12 mb-3'>
                        <div class='card border border-dark h-100'>
                          <img src='./admin_area/product_images/$product_image1' 
                            class='card-img-top object-fit-contain p-2' alt='$product_title' width='100%' height='350px' >
                            <div class='card-body'>
                              <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'><b>NPR: $product_price /-</b></p>
                              <a href='home.php?add_to_cart=$product_id' 
                              class='mbtn3 p-2 my-1'>Add to cart</a>
                              <a href='product_details.php?product_id=$product_id' 
                              class='mbtn3 p-2 my-1'>View More</a>
                            </div>
                        </div>
                        </div>";
    }
    echo "</div></div>";
  }
}
}

function view_details()
{
  global $con;
  if (isset($_GET['product_id'])) {
    $product_id1 = $_GET['product_id'];
    $select_query = "Select * from products where product_id=$product_id1 ";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $category_id = $row['category_id'];
      $product_image1 = $row['product_image1'];
      $product_image2 = $row['product_image2'];
      $product_image3 = $row['product_image3'];
      $product_price = $row['product_price'];
      echo "<section class='products' id='productss'>
                        <div class='container'>
                          <div class='row d-flex justify-content-center'>
                            <div id='carouselExampleControls' class='carousel carousel-dark slide' data-bs-ride='carousel'>
                              <div class='carousel-inner'>
                                <div class='carousel-item active'>
                                  <div class='row g-3 d-flex justify-content-center'>
                                  <div class='col-lg-4 col-md-6 col-sm-12'>
                        <div class='cards-wrapper'>
                          <div class='card py-3 mb-3' style='width: 18rem;'>
                            <div class='image-wrapper'>
                              <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                            </div>
                            <div class='card-body'>
                              <h5 class='card-title'>$product_title</h5>
                              <p class='card-text'>$product_description</p>
                              <p class='card-text'>NPR: $product_price /-</p>
                              <a href='home.php?add_to_cart=$product_id' class='mbtn3 p-2 my-1'>Add To Cart</a>
                              <a href='home.php' class='mbtn3 p-2 my-1'>Go home</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                      <h1 class='text-center'>RELATED <span class='px-4'>PRODUCTS</span></h1>
</div>
                      <div class='col-lg-3 col-md-6 col-sm-12'>
                  <div class='cards-wrapper'>
                    <div class='card py-3 mb-3' style='width: 18rem;'>
                      <div class='image-wrapper'>
                        <img src='./admin_area/product_images/$product_image2' alt='...'>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='col-lg-3 col-md-6 col-sm-12'>
                  <div class='cards-wrapper'>
                    <div class='card py-3 mb-3' style='width: 18rem;'>
                      <div class='image-wrapper'>
                        <img src='./admin_area/product_images/$product_image3' alt='...'>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div> </div></div></div></div></div></div></section>";
    }
  }
}

function getIPAddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip; 


function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_address = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];
    $select_query = "Select * from cart_details where ip_address='$get_ip_address' and
       product_id=$get_product_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);

    if ($num_of_rows > 0) {
      echo "<script>alert('This item is already present inside cart')</script>";
      echo "<script>window.open('home.php','_self')</script>";
    } else {
      if (!isset($_SESSION['user_id'])) {
        $insert_query = "Insert into cart_details (product_id,quantity,ip_address,user_id) values
        ($get_product_id,1,'$get_ip_address',0)";
        $result_query = mysqli_query($con, $insert_query);
        echo "<script>alert('Item is added to cart')</script>";
        echo "<script>window.open('home.php','_self')</script>";
      }
      else if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $insert_query = "Insert into cart_details (product_id,quantity,ip_address,user_id) values
        ($get_product_id,1,'$get_ip_address',$user_id)";
        $result_query = mysqli_query($con, $insert_query);
        echo "<script>alert('Item is added to cart')</script>";
        echo "<script>window.open('home.php','_self')</script>";
      }
    }
  }
}


// function cart_item()
// {
//   if (isset($_GET['add_to_cart'])) {
//     global $con;
//     $get_ip_address = getIPAddress();
//     $select_query = "Select * from cart_details where ip_address='$get_ip_address'";
//     $result_query = mysqli_query($con, $select_query);
//     $count_cart_items = mysqli_num_rows($result_query);
//   } else {
//     global $con;
//     $get_ip_address = getIPAddress();
//     $select_query = "Select * from cart_details where ip_address='$get_ip_address'";
//     $result_query = mysqli_query($con, $select_query);
//     $count_cart_items = mysqli_num_rows($result_query);
//   }
//   echo $count_cart_items;
// }
function cart_item()
{
    global $con;
    $get_ip_address = getIPAddress();
    $quantity=0;
    if(isset($_SESSION['user_id']))
    {
      $user_id=$_SESSION['user_id'];
    }
    else{
      $user_id=0;
    }
    if(isset($_GET['add_to_cart()'])){
      $product_id=$_GET['add_to_cart'];
      $insert_query=mysqli_query($con,"Insert into cart_details(product_id,quantity,ip_address,user_id) values
      ($product_id,$quantity,'$get_ip_address',$user_id) where product_id=$product_id");

    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
    }
    else {
          global $con;
          $get_ip_address = getIPAddress();
          $select_query = "Select * from cart_details where ip_address='$get_ip_address'";
          $result_query = mysqli_query($con, $select_query);
          $count_cart_items = mysqli_num_rows($result_query);
}
echo $count_cart_items;
}


// function total_cart_price()
// {
//   global $con;
//   $user_id=$_SESSION['user_id'];
//   $total_price = 0;
//   $cart_query = "Select * from cart_details where user_id=$user_id";
//   $result = mysqli_query($con, $cart_query);
//   while ($row = mysqli_fetch_array($result)) {
//     $product_id = $row['product_id'];
//     $select_products = "Select * from products where product_id=$product_id";
//     $result_products = mysqli_query($con, $select_products);
//     while ($row_product_price = mysqli_fetch_array($result_products)) {
//       $product_price = array($row_product_price['product_price']);
//       $product_values = array_sum($product_price);
//       $total_price += $product_values;
//     }
//   }
//   echo $total_price;
// }






//get user order 
function get_user_order_details()
{
  global $con;
  $username = $_SESSION['username'];
  $get_details = "Select * from user_table where username='$username'";
  $result_query = mysqli_query($con, $get_details);
  while ($row_query = mysqli_fetch_array($result_query)) {
    $user_id = $row_query['user_id'];
    if (!isset($_GET['feedback'])) {
      if (!isset($_GET['edit_account'])) {
        if (!isset($_GET['my_orders'])) {
          if (!isset($_GET['delete_account'])) {
            $get_orders = "Select * from user_orders where user_id=$user_id and 
           order_status='pending'";
            $result_orders_query = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result_orders_query);
            if ($row_count > 0) {
              echo "<h3 class='text-center my-5 pt-5'>You have <b class='text-danger'>$row_count</b>
             pending orders</h3>";
              echo "<p class='text-center fs-4'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
            } else {
              echo "<h3 class='text-center my-5 pt-5'>You have zero pending orders</h3>";
              echo "<p class='text-center fs-4'><a href='../home.php' class='text-dark'>Explore Products</a></p>";
            }
          }
        }
      }
    }
  }
}

function admin_front()
{
  global $con;
  // if(!isset($_GET['insert_about_us']))
  // {
  // if (!isset($_GET['list_about_us'])) {
    if (!isset($_GET['get_message'])) {
    if (!isset($_GET['edit_about_us'])) {
    if (!isset($_GET['insert_product'])) {
      if (!isset($_GET['insertcategoriess'])) {
        if (!isset($_GET['view_products'])) {
          if (!isset($_GET['edit_products'])) { 
          if (!isset($_GET['view_categories'])) {
            if (!isset($_GET['edit_category'])) {
            if (!isset($_GET['list_users'])) {
              if (!isset($_GET['list_orders'])) {
                if (!isset($_GET['delete_account'])) {
                  if (!isset($_GET['edit_account'])) {
                    if (!isset($_GET['list_payments'])) {
                      $get_products = "Select * from products";
                      $result1 = mysqli_query($con, $get_products);
                      $row_count1 = mysqli_num_rows($result1);

                      $get_categories = "Select * from categories";
                      $result2 = mysqli_query($con, $get_categories);
                      $row_count2 = mysqli_num_rows($result2);

                      $get_orders = "Select * from user_orders";
                      $result3 = mysqli_query($con, $get_orders);
                      $row_count3 = mysqli_num_rows($result3);

                      $get_users = "Select * from user_table where user_type='User'";
                      $result4 = mysqli_query($con, $get_users);
                      $row_count4 = mysqli_num_rows($result4);

                      $get_notification = "Select * from chat where is_read = 0";
                      $result5 = mysqli_query($con, $get_notification);
                      $row_count5 = mysqli_num_rows($result5);

                      echo "
                      
          <div class='d-flex justify-content-center align-items-center' style='height: 100vh;'>
          <div class='row'>
              <div class='col-sm-6 col-lg-6 mb-3'>
                  <div class='card  bg border shadow rounded'>
                  <div class='card-body text-center'>
                      <h5 class='card-title'><i class='bi bi-gift d-block fs-1 mb-3'></i>Products
                   ($row_count1)
                   </h5>
                      
                  </div>
                  </div>
              </div>";

                      echo "<div class='col-sm-6 col-lg-6 mb-3'>
                  <div class='card  bg border shadow rounded'>
                  <div class='card-body text-center'>
                  <h5 class='card-title'><i class='bi bi-list-task d-block fs-1 mb-3'></i>Categories
                  ($row_count2) 
                 </h5>
                      
                  </div>
                  </div>
              </div>
              <div class='col-sm-6 col-lg-6 mb-3'>
                  <div class='card bg border shadow rounded'>
                  <div class='card-body text-center'>
                  <h5 class='card-title'><i class='bi bi-card-checklist d-block fs-1 mb-3'></i>Order
                   ($row_count3) 
                  </h5>
                      
                  </div>
                  </div>
              </div>";
                      echo "<div class='col-sm-6 col-lg-6 mb-3'>
                        <div class='card  bg border shadow rounded'>
                        <div class='card-body text-center'>
                        <h5 class='card-title'><i class='bi bi-people d-block fs-1 mb-3'></i>Users 

                         ($row_count4) 
                        </h5>
                            
                        </div>
                        </div>
                    </div>";
                    echo"<div class='col-sm-6 col-lg-6 mb-3'>
                    <div class='card  bg border shadow rounded'>
                    <div class='card-body text-center'>
                    <h5 class='card-title'><i class='bi bi-bell d-block fs-1 mb-3'></i>Notifications 

                     ($row_count5) 
                    </h5>
                        
                    </div>
                    </div>
                </div>
              </div>
              </div>
              ";
                    }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}}}

?>