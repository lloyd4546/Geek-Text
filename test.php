<?php
// including database connection
require 'init.php';
include 'header.php';




if(isset($_GET['page'])){
    // if get page number through url and check it is a valid number
    $page_num = filter_var($_GET['page'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 1,
            'min_range' => 1
        ]
    ]); 
    
}else{
    //default page number
    $page_num = 1;
}
// set how much show posts in a single page
$page_limit = 10;
// Set Offset
$page_offset = $page_limit * ($page_num - 1);

function showPosts($conn, $current_page_num, $page_limit, $page_offset){   
      

        if(isset($_POST['data'])){
		
        $query = mysqli_query($conn,"SELECT booktitle, price, bookid, bookcover, bookrating FROM book ORDER BY price LIMIT $page_limit OFFSET $page_offset");
        }
        else if(isset($_POST['Author'])){
        
        $query = mysqli_query($conn,"SELECT booktitle, price, bookid, bookcover, bookrating, authorname FROM book JOIN author on book.authorid = author.authorid order by authorname LIMIT $page_limit OFFSET $page_offset");
        }
        else if(isset($_POST['title'])){
        
        $query = mysqli_query($conn,"SELECT booktitle, price, bookid, bookcover, bookrating FROM book ORDER BY booktitle LIMIT $page_limit OFFSET $page_offset");
        }
         else if(isset($_POST['rating'])){
        
        $query = mysqli_query($conn,"SELECT booktitle, price, bookid, bookcover, bookrating FROM book ORDER BY bookrating desc LIMIT $page_limit OFFSET $page_offset");
        }
        else if(isset($_POST['date'])){
        
        $query = mysqli_query($conn,"SELECT booktitle, price, bookid, bookcover, bookrating FROM book ORDER BY releasedate LIMIT $page_limit OFFSET $page_offset");
        }
        else{
    	// query of fetching posts
    	$query = mysqli_query($conn,"SELECT booktitle, price, bookid, bookcover, bookrating FROM book ORDER BY bookid LIMIT $page_limit OFFSET $page_offset");
		}
    
    // check database is not empty
    if(mysqli_num_rows($query) > 0){
        
        // fetching data
        echo'<div style="display:flex; flex-wrap: wrap;">';
        while($row = mysqli_fetch_array($query)){
        // display books	
		include("response.php");
        }
        
        // total number of posts
        $total_posts = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM book"));
        
        // total number of pages
        $total_page = ceil($total_posts / $page_limit);
        // set next page number
        $next_page = $current_page_num+1; 
        // set prev page number
        $prev_page = $current_page_num-1; 
        ?>
        <div id="container" style="width: 960px; border:1px;">
		</div>
<?php
        
       echo "<li>";
        //showing prev button and check current page number is greater than 1
        if($current_page_num > 1){
           echo '<a href="?page='.$prev_page.'" class="page_link">Prev</a>';
        }
        // show all number of pages
        for($i = 1; $i <= $total_page; $i++){
            //highlight the current page number
            if($i == $current_page_num){
                echo '<a href="?page='.$i.'" class="page_link active_page">'.$i.'</a>';
            }else{
                echo '<a href="?page='.$i.'" class="page_link">'.$i.'</a>';
            }
            
        }
        // showing next button and check this is last page
        if($total_page+1 != $next_page){
           echo '<a href="?page='.$next_page.'" class="page_link">Next</a>';
        }
        
        echo "</li>";  
        
    }else{
        echo "No Data found !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            padding:0;
            margin: 0;
            font-family: sans-serif;
        }
        .page_link{
            display: inline-block;
            color: #222;
            border: 1px solid #ddd;
            padding: 5px 10px;
            margin: 0 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .active_page{
            background-color:dodgerblue;
            color: #FFF;
            outline: none;
            border: 1px solid rgba(0,0,0,.1);
        }
        .container{
            border: 2px solid #ccc;
            padding: 10px;
        }
        .posts{
            margin: 0;
            list-style: none;
            padding: 20px;
        }
        .posts li{
            padding:10px 5px;
            border-bottom: 1px solid #ddd;
            margin: auto;
            
        }

        /*-------------product-top CSS----------------*/

.overlay-right
{
    display: block;
    opacity: 0;
    position: absolute;
    top: 10%;
    margin-left: 0;
    width: 70px;
}
.overlay-right .fa
{
    cursor: pointer;
    background-color: #fff;
    color: #000;
    height: 35px;
    width: 35px;
    font-size: 20px;
    padding: 7px;
    margin-top: 5%;
    margin-bottom: 5%;
}
.overlay-right .btn-secondary
{
    background: none !important;
    border: none !important;
    box-shadow: none !important;
}
.product-top:hover .overlay-right
{
    opacity: 1;
    margin-left: 5%;
    transition: 0.5s;
}

/*--------------Product-bottom-CSS---------------*/

.product-bottom .fa
{
    color: orange;
    font-size: 30px;
}
.product-bottom h3
{
    font-size: 20px;
    font-weight: bold;
}
.product-bottom h5
{
    font-size: 15px;
    padding-bottom: 10px;
}
.new-products
{
    margin: 50px 0;
}
        
    </style>
</head>

<body>
   <h1 style="text-align:center;">Geek Text</h1>
   <form method="POST" action="test.php" align="center">
        <input type="submit" name="data" class="btn btn-default" value="Sort by Price" />
        <input type="submit" name="author" class="btn btn-default" value="Sort by Author"/>
        <input type="submit" name="title" class="btn btn-default" value="Sort by Title"/>
        <input type="submit" name="rating" class="btn btn-default" value="Sort by Book Rating"/>
        <input type="submit" name="date" class="btn btn-default" value="Sort by Release Date"/>
    </form>
    <div class="container">
        <ul class="posts">
<?php 
// call showPosts function 
showPosts($conn, $page_num, $page_limit, $page_offset);
?>   
        </ul>
    </div> 
</body>
</html>
