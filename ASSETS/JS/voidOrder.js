const productToRemoveDetails = document.querySelector(
  "#productToRemoveDetails"
);
const o_ref = document.querySelector("#oRefInput");
let order_ref = o_ref.value;

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
