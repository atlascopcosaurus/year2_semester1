<?php

function component($productname, $productprice, $productimg, $productid, $productdescription, $quantity, $author, $publication_date, $category){
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
        <form action=\"index.php\" method=\"post\">
            <div class=\"card shadow\">
                <div>
                    <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$productname</h5>
                    <p class=\"card-text\">$productdescription</p>
                    <p class=\"card-text\">Author: $author</p>
                    <p class=\"card-text\">Date of Publication: $publication_date</p>
                    <p class=\"card-text\">Category: $category</p>
                    <p class=\"card-text\">Available Quantity: $quantity</p>
                    <h5>
                        <span class=\"price\">MUR $productprice</span>
                    </h5>

                    <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type='hidden' name='product_id' value='$productid'>
                </div>
            </div>
        </form>
    </div>
    ";
    echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid, $quantity, $productdescription, $author, $publication_date, $category, $available_quantity){
    $element = "
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
        <div class=\"border rounded\">
            <div class=\"row bg-white\">
                <div class=\"col-md-3 pl-0\">
                    <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid\">
                </div>
                <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productname</h5>
                    <p class=\"text-secondary\">Description: $productdescription</p>
                    <p class=\"text-secondary\">Author: $author</p>
                    <p class=\"text-secondary\">Date of Publication: $publication_date</p>
                    <p class=\"text-secondary\">Category: $category</p>
                    <p class=\"text-secondary\">Available Quantity: $available_quantity</p>
                    <h5 class=\"pt-2\">MUR $productprice</h5>
                    <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                </div>
                <div class=\"col-md-3 py-5\">
                    <div>
                        <button type=\"submit\" class=\"btn bg-light border rounded-circle\" name=\"decrease\"><i class=\"fas fa-minus\"></i></button>
                        <input type=\"text\" name=\"quantity\" value=\"$quantity\" class=\"form-control w-25 d-inline text-center\" readonly>
                        <button type=\"submit\" class=\"btn bg-light border rounded-circle\" name=\"increase\"><i class=\"fas fa-plus\"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    ";
    echo $element;
}
