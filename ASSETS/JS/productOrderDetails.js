/* VARIABLES */
const productTypeSection = document.querySelector("#product_type");
const productCategorySection = document.querySelector("#product_category");
const productDetails = document.querySelector("#productDetails");
const productToRemoveDetails = document.querySelector(
  "#productToRemoveDetails"
);
const special = document.querySelector(".specialEvent");
let edit_modal = document.querySelector(".edit_modal");
const o_ref = document.querySelector("#oRefInput");
let order_ref = o_ref.value;

if (special) {
  // SPECIAL EVENT

  function displayModal() {
    edit_modal.classList.remove("hide");
  }

  function addHide() {
    edit_modal.classList.add("hide");
  }

  // if (productTypeSection) {
  function fetchProductType() {
    fetch("../../API/CONTROLLER/ProductTypeController.php?action=fetchType")
      .then((Response) => Response.json())
      .then(function (result) {
        for (let item of result) {
          for (let key of item) {
            productTypeSection.innerHTML += `
                    <button type="button"  class="btn btn-outline-danger btn-sm" onclick ="resetCategorySection(),fetchProductCategories(${key.PT_ID})" id="${key.PT_ID}">${key.PT_NAME}</button>&nbsp;
                    `;
          }
        }
      });
  }

  fetchProductType();
  // }

  if (productCategorySection) {
    function resetCategorySection() {
      productCategorySection.innerHTML = "";
    }
    resetCategorySection();

    function fetchProductCategories(pt_id) {
      fetch(
        "../../API/CONTROLLER/ProductCategoryController.php?action=fetchType&pt_id=" +
          pt_id +
          ""
      )
        .then((Response) => Response.json())
        .then(function (result) {
          for (let item of result) {
            for (let key of item) {
              productCategorySection.innerHTML += `
                    <button type="button"  class="btn btn-warning btn-sm m-1" onclick="resetProductSection(),fetchProductByCategory(${key.PC_ID})">${key.PC_NAME}</button>&nbsp;
                    `;
              //   console.log(key);
            }
          }
        });
    }
  }
  let theSearchedProduct = "";

  document
    .getElementById("searchByCharacter")
    .addEventListener("submit", function (event) {
      event.preventDefault();
      // window.alert("welcome" + document.querySelector("#characterProduct").value);
      console.log(document.querySelector("#characterProduct").value);
      theSearchedProduct = document.querySelector("#characterProduct").value;
      theSearchedProduct;
      console.log(theSearchedProduct);
    });
  // console.log(theSearchedProduct);

  // if (productDetails) {
  function resetProductSection() {
    productDetails.innerHTML = "";
  }

  function fetchProductByCategory(pc_id) {
    fetch(
      `../../API/CONTROLLER/PricesController.php?action=fetchProduct&pc_id=${pc_id}`
    )
      .then((response) => response.json())
      .then(function (result) {
        let found = false;
        for (let item of result) {
          for (let key of item) {
            console.log(key);

            if (key.P_NAME.charAt(0).toLowerCase() === " ") {
              // Display only the product whose name starts with 'A'
              productDetails.innerHTML = `
                <div class="col-md-4 mb-1 btn" onclick="resetModalSection(),fetchProductToOrder(${key.P_ID},${key.PRICE_ID}),displayModal()">
                  <div class="card" style="height:176px;">
                    <div class="card-header">
                      <h6 class="card-title" style="font-size:12px;">PRODUCT</h6>
                    </div>
                    <div class="card-body">
                      <div class="mx-auto d-block">
                        <img class=" mx-auto d-block" src="../../ASSETS/PIMAGES/${key.PI_NAME}" alt="Products Image" style="width: 50px; height: 50px">
                        <h6 class="text-sm-center mt-2 mb-1" style="font-size:8px;font-weight:bold;">${key.P_NAME}</h6>
                        <div class="location text-sm-center" style="font-size:9px;font-weight:bold;">${key.EPRICE}&nbsp;Frw&nbsp;Per&nbsp;${key.UNITY_NAME}</div>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
              `;
              found = true; // Mark as found
              break; // Exit the loop since we found the product
            }
          }
          if (found) break; // Exit the outer loop as well
        }

        // If no product with name starting with 'A' found, display all products
        if (!found) {
          productDetails.innerHTML = "";
          for (let item of result) {
            for (let key of item) {
              productDetails.innerHTML += `
                <div class="col-md-4 mb-1 btn" onclick="resetModalSection(),fetchProductToOrder(${key.P_ID},${key.PRICE_ID}),displayModal()">
                  <div class="card" style="height:176px;">
                    <div class="card-header">
                      <h6 class="card-title" style="font-size:12px;">PRODUCT</h6>
                    </div>
                    <div class="card-body">
                      <div class="mx-auto d-block">
                        <img class=" mx-auto d-block" src="../../ASSETS/PIMAGES/${key.PI_NAME}" alt="Products Image" style="width: 50px; height: 50px">
                        <h6 class="text-sm-center mt-2 mb-1" style="font-size:8px;font-weight:bold;">${key.P_NAME}</h6>
                        <div class="location text-sm-center" style="font-size:9px;font-weight:bold;">${key.EPRICE}&nbsp;Frw&nbsp;Per&nbsp;${key.UNITY_NAME}</div>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
              `;
            }
          }
        }
      });
  }

  // }

  function resetModalSection() {
    edit_modal.innerHTML = "";
  }

  function fetchProductToOrder(p_id, price_id) {
    fetch(
      "../../API/CONTROLLER/PricesController.php?action=fetchOrder&p_id=" +
        p_id +
        "&price_id=" +
        price_id +
        ""
    )
      .then((Response) => Response.json())
      .then(function (result) {
        console.log(result[0].P_ID);
        edit_modal.innerHTML += `
   <div class="col-lg-6 MyModal"> 
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Order&nbsp;Note</strong>
            </div>
            <div class="card-body">
                <!-- Credit Card -->
                <div id="pay-invoice">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Order&nbsp;Note&nbsp;With&nbsp;Reference:&nbsp;${o_ref.value}</h3>
                        </div>
                        <hr>
                        <form action="../../API/CONTROLLER/SpecialDetailsController.php?action=insert&o_ref=${o_ref.value}" method="post">
                            <div class="form-group text-center">
                                
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT</label>
                                <input id="p_name" name="p_name" type="text" value="${result[0].P_NAME}" disabled class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">PURCHASE PRICE</label>
                                <input id="p_pprice" name="p_pprice" type="text" value="${result[0].PPRICE}"  class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
  
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">SELLING PRICE</label>
                                <input id="p_sprice"  type="text" value="${result[0].EPRICE}" disabled class="form-control"  required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">SELLING PRICE</label>
                                <input id="p_sprice" name="p_sprice" type="text" value="${result[0].EPRICE}"  class="form-control"  required>
                            </div>
  
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT</label>
                                <input id="p_name" name="unity_name" type="text" value="${result[0].UNITY_NAME}" disabled class="form-control"  required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT&nbsp;UNITY</label>
                                <input id="unity_id" name="unity_id" type="text" value="${result[0].UNITY_ID}"  class="form-control"  required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">CATEGORY</label>
                                <input id="pc_id" name="pc_id" type="text" value="${result[0].PC_ID}"  class="form-control"  required>
                            </div>
  
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">QUANTITY</label>
                                <input id="p_qty" name="p_qty" type="number" value="${result[0].P_QTY}" placeholder="ENTER QUANTITY"  class="form-control"   required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT_ID</label>
                                <input id="p_id" name="p_id" type="text" value="${result[0].P_ID}"  class="form-control"  required>
                            </div>
                              <div class="place_order_error_msg">
                               
                              </div>
                            <div>
                                  <button id="placeSpecial" name="placeSpecial" type="submit" class="btn btn-lg btn-info btn-block mt-1 w-50 btn-sm" style="font-size:15px;">
                                     PLACE&nbsp;ORDER
                                  </button>
                             </div>
                        </form>
                    </div>
                </div>
  
            </div>
            <div class="modal-footer">
                      <button type="submit" class="btn btn-secondary closeModal" onclick="addHide()">Close</button>          
                      </div>
        </div> <!-- .card -->
  
  </div>
  
        `;
      });
  }

  function validateOrderForm() {
    if (document.querySelector("#p_qty").value == "") {
      document.querySelector(".place_order_error_msg").innerHTML =
        " <h6>INSERT PRODUCT QUANTITY</h6>";
    }
  }

  function fetchProductByOrder(order_ref) {
    fetch(
      "../../API/CONTROLLER/SpecialDetailsController.php?action=fetchOrder&o_ref=" +
        order_ref +
        ""
    )
      .then((Response) => Response.json())
      .then(function (result) {
        for (let item of result) {
          for (let key of item) {
            productToRemoveDetails.innerHTML += `
            <div class="col-md-4 mb-1 btn" onclick="resetModalSection(),fetchProductToOrder(${key.P_ID},${key.PRICE_ID}),displayModal()">
            <div class="card" style="height:176px;">
                <div class="card-header">
                    <h6 class="card-title" style="font-size:12px;">PRODUCT</h6>
                </div>
                <div class="card-body">
                    <div class="mx-auto d-block">
                        <img class=" mx-auto d-block" src="../../ASSETS/PIMAGES/${key.PI_NAME}" alt="Products Image" style="width: 50px; height: 50px">
                        <h6 class="text-sm-center mt-2 mb-1" style="font-size:8px;font-weight:bold;">${key.P_NAME}</h6>
                        <div class="location text-sm-center" style="font-size:9px;font-weight:bold;">${key.EPRICE}&nbsp;Frw&nbsp;Per&nbsp;${key.UNITY_NAME}</div>
                    </div>
                    <hr>
                </div>
            </div>
            </div>
                      `;
            // console.log(key);
          }
        }
      });
  }
} else {
  //ORDINARY EVENT

  function displayModal() {
    edit_modal.classList.remove("hide");
  }

  function addHide() {
    edit_modal.classList.add("hide");
  }

  // if (productTypeSection) {
  function fetchProductType() {
    fetch("../../API/CONTROLLER/ProductTypeController.php?action=fetchType")
      .then((Response) => Response.json())
      .then(function (result) {
        for (let item of result) {
          for (let key of item) {
            productTypeSection.innerHTML += `
                    <button type="button"  class="btn btn-outline-danger btn-sm" onclick ="resetCategorySection(),fetchProductCategories(${key.PT_ID})" id="${key.PT_ID}">${key.PT_NAME}</button>&nbsp;
                    `;
          }
        }
      });
  }

  fetchProductType();
  // }

  if (productCategorySection) {
    function resetCategorySection() {
      productCategorySection.innerHTML = "";
    }
    resetCategorySection();

    function fetchProductCategories(pt_id) {
      fetch(
        "../../API/CONTROLLER/ProductCategoryController.php?action=fetchType&pt_id=" +
          pt_id +
          ""
      )
        .then((Response) => Response.json())
        .then(function (result) {
          for (let item of result) {
            for (let key of item) {
              productCategorySection.innerHTML += `
                    <button type="button"  class="btn btn-warning btn-sm m-1" onclick="resetProductSection(),fetchProductByCategory(${key.PC_ID})">${key.PC_NAME}</button>&nbsp;
                    `;
              //   console.log(key);
            }
          }
        });
    }
  }
  let theSearchedProduct = "";

  document
    .getElementById("searchByCharacter")
    .addEventListener("submit", function (event) {
      event.preventDefault();
      // window.alert("welcome" + document.querySelector("#characterProduct").value);
      console.log(document.querySelector("#characterProduct").value);
      theSearchedProduct = document.querySelector("#characterProduct").value;
      theSearchedProduct;
      console.log(theSearchedProduct);
    });
  // console.log(theSearchedProduct);

  // if (productDetails) {
  function resetProductSection() {
    productDetails.innerHTML = "";
  }

  function fetchProductByCategory(pc_id) {
    fetch(
      `../../API/CONTROLLER/PricesController.php?action=fetchProduct&pc_id=${pc_id}`
    )
      .then((response) => response.json())
      .then(function (result) {
        let found = false;
        for (let item of result) {
          for (let key of item) {
            console.log(key);

            if (key.P_NAME.charAt(0).toLowerCase() === " ") {
              // Display only the product whose name starts with 'A'
              productDetails.innerHTML = `
                <div class="col-md-4 mb-1 btn" onclick="resetModalSection(),fetchProductToOrder(${key.P_ID},${key.PRICE_ID}),displayModal()">
                  <div class="card" style="height:176px;">
                    <div class="card-header">
                      <h6 class="card-title" style="font-size:12px;">PRODUCT</h6>
                    </div>
                    <div class="card-body">
                      <div class="mx-auto d-block">
                        <img class=" mx-auto d-block" src="../../ASSETS/PIMAGES/${key.PI_NAME}" alt="Products Image" style="width: 50px; height: 50px">
                        <h6 class="text-sm-center mt-2 mb-1" style="font-size:8px;font-weight:bold;">${key.P_NAME}</h6>
                        <div class="location text-sm-center" style="font-size:9px;font-weight:bold;">${key.SPRICE}&nbsp;Frw&nbsp;Per&nbsp;${key.UNITY_NAME}</div>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
              `;
              found = true; // Mark as found
              break; // Exit the loop since we found the product
            }
          }
          if (found) break; // Exit the outer loop as well
        }

        // If no product with name starting with 'A' found, display all products
        if (!found) {
          productDetails.innerHTML = "";
          for (let item of result) {
            for (let key of item) {
              productDetails.innerHTML += `
                <div class="col-md-4 mb-1 btn" onclick="resetModalSection(),fetchProductToOrder(${key.P_ID},${key.PRICE_ID}),displayModal()">
                  <div class="card" style="height:176px;">
                    <div class="card-header">
                      <h6 class="card-title" style="font-size:12px;">PRODUCT</h6>
                    </div>
                    <div class="card-body">
                      <div class="mx-auto d-block">
                        <img class=" mx-auto d-block" src="../../ASSETS/PIMAGES/${key.PI_NAME}" alt="Products Image" style="width: 50px; height: 50px">
                        <h6 class="text-sm-center mt-2 mb-1" style="font-size:8px;font-weight:bold;">${key.P_NAME}</h6>
                        <div class="location text-sm-center" style="font-size:9px;font-weight:bold;">${key.SPRICE}&nbsp;Frw&nbsp;Per&nbsp;${key.UNITY_NAME}</div>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
              `;
            }
          }
        }
      });
  }

  // }

  function resetModalSection() {
    edit_modal.innerHTML = "";
  }

  function fetchProductToOrder(p_id, price_id) {
    fetch(
      "../../API/CONTROLLER/PricesController.php?action=fetchOrder&p_id=" +
        p_id +
        "&price_id=" +
        price_id +
        ""
    )
      .then((Response) => Response.json())
      .then(function (result) {
        console.log(result[0].P_ID);
        edit_modal.innerHTML += `
   <div class="col-lg-6 MyModal"> 
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Order&nbsp;Note</strong>
            </div>
            <div class="card-body">
                <!-- Credit Card -->
                <div id="pay-invoice">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Order&nbsp;Note&nbsp;With&nbsp;Reference:&nbsp;${o_ref.value}</h3>
                        </div>
                        <hr>
                        <form action="../../API/CONTROLLER/OrderDetailsController.php?action=insert&o_ref=${o_ref.value}" method="post">
                            <div class="form-group text-center">
                                
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT</label>
                                <input id="p_name" name="p_name" type="text" value="${result[0].P_NAME}" disabled class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">PURCHASE PRICE</label>
                                <input id="p_pprice" name="p_pprice" type="text" value="${result[0].PPRICE}"  class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
  
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">SELLING PRICE</label>
                                <input id="p_sprice"  type="text" value="${result[0].SPRICE}" disabled class="form-control"  required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">SELLING PRICE</label>
                                <input id="p_sprice" name="p_sprice" type="text" value="${result[0].SPRICE}"  class="form-control"  required>
                            </div>
  
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT</label>
                                <input id="p_name" name="unity_name" type="text" value="${result[0].UNITY_NAME}" disabled class="form-control"  required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT&nbsp;UNITY</label>
                                <input id="unity_id" name="unity_id" type="text" value="${result[0].UNITY_ID}"  class="form-control"  required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">CATEGORY</label>
                                <input id="pc_id" name="pc_id" type="text" value="${result[0].PC_ID}"  class="form-control"  required>
                            </div>
  
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">QUANTITY</label>
                                <input id="p_qty" name="p_qty" type="number" value="${result[0].P_QTY}" placeholder="ENTER QUANTITY"  class="form-control"   required>
                            </div>
  
                            <div class="form-group" style="display:none;">
                                <label for="cc-payment" class="control-label mb-1">PRODUCT_ID</label>
                                <input id="p_id" name="p_id" type="text" value="${result[0].P_ID}"  class="form-control"  required>
                            </div>
                              <div class="place_order_error_msg">
                               
                              </div>
                            <div>
                                  <button id="placeOrder" name="placeOrder" type="submit" class="btn btn-lg btn-info btn-block mt-1 w-50 btn-sm" style="font-size:15px;">
                                     PLACE&nbsp;ORDER
                                  </button>
                             </div>
                        </form>
                    </div>
                </div>
  
            </div>
            <div class="modal-footer">
                      <button type="submit" class="btn btn-secondary closeModal" onclick="addHide()">Close</button>          
                      </div>
        </div> <!-- .card -->
  
  </div>
  
        `;
      });
  }

  function validateOrderForm() {
    if (document.querySelector("#p_qty").value == "") {
      document.querySelector(".place_order_error_msg").innerHTML =
        " <h6>INSERT PRODUCT QUANTITY</h6>";
    }
  }

  function fetchProductByOrder(order_ref) {
    fetch(
      "../../API/CONTROLLER/OrderDetailsController.php?action=fetchOrder&o_ref=" +
        order_ref +
        ""
    )
      .then((Response) => Response.json())
      .then(function (result) {
        for (let item of result) {
          for (let key of item) {
            productToRemoveDetails.innerHTML += `
            <div class="col-md-4 mb-1 btn" onclick="resetModalSection(),fetchProductToOrder(${key.P_ID},${key.PRICE_ID}),displayModal()">
            <div class="card" style="height:176px;">
                <div class="card-header">
                    <h6 class="card-title" style="font-size:12px;">PRODUCT</h6>
                </div>
                <div class="card-body">
                    <div class="mx-auto d-block">
                        <img class=" mx-auto d-block" src="../../ASSETS/PIMAGES/${key.PI_NAME}" alt="Products Image" style="width: 50px; height: 50px">
                        <h6 class="text-sm-center mt-2 mb-1" style="font-size:8px;font-weight:bold;">${key.P_NAME}</h6>
                        <div class="location text-sm-center" style="font-size:9px;font-weight:bold;">${key.SPRICE}&nbsp;Frw&nbsp;Per&nbsp;${key.UNITY_NAME}</div>
                    </div>
                    <hr>
                </div>
            </div>
            </div>
                      `;
            console.log(key);
          }
        }
      });
  }
}

/*INVOCATION OF FUNCTION*/
// fetchProductCategories(pc_id);
// fetchProductByCategory(pc_id);
// fetchProductToOrder(p_id, price_id);
