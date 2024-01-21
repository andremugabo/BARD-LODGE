/* VARIABLES */
const productTypeSection = document.querySelector("#product_type");
const productCategorySection = document.querySelector("#product_category");
const productDetails = document.querySelector("#productDetails");

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

function resetCategorySection() {
  productCategorySection.innerHTML = "";
}

function resetProductSection() {
  productDetails.innerHTML = "";
}

function fetchProductByCategory(pc_id) {
  fetch(
    "../../API/CONTROLLER/PricesController.php?action=fetchProduct&pc_id=" +
      pc_id +
      ""
  )
    .then((Response) => Response.json())
    .then(function (result) {
      for (let item of result) {
        for (let key of item) {
          productDetails.innerHTML += `
          <div class="col-md-4 mb-1 btn">
          <div class="card" style="height:176px;">
              <div class="card-header">
                  <h6 class="card-title" style="font-size:12px;">PRODUCT</h6>
              </div>
              <div class="card-body">
                  <div class="mx-auto d-block">
                      <img class=" mx-auto d-block" src="../../ASSETS/PIMAGES/${key.PI_NAME}" alt="Products Image" style="width: 45px; height: 45px">
                      <h6 class="text-sm-center mt-2 mb-1" style="font-size:8px;font-weight:bold;">${key.P_NAME}</h6>
                      <div class="location text-sm-center" style="font-size:9px;font-weight:bold;">${key.SPRICE}&nbsp;Frw&nbsp;Per&nbsp;${key.UNITY_NAME}</div>
                      <div class="location text-sm-center"></div>
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
/*INVOCATION OF FUNCTION*/
resetCategorySection();
fetchProductType();
fetchProductCategories(pc_id);
fetchProductByCategory(pc_id);
