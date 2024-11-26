var modal = document.getElementById("editModal");
var editBtns = document.querySelectorAll(".edit-btn");

editBtns.forEach(function (btn) {
    btn.onclick = function () {
        const table = document.body.dataset.table;

        if (table === "models") {
            document.getElementById("model_id").value = this.dataset.id || '';
            document.getElementById("model_name").value = this.dataset.name || '';
            document.getElementById("model_model").value = this.dataset.model || '';
            document.getElementById("model_characteristics").value = this.dataset.characteristics || '';
            document.getElementById("model_price").value = this.dataset.price || '';
        }

        if (table === "customers") {
            document.getElementById("customer_id").value = this.dataset.id || '';
            document.getElementById("customer_name").value = this.dataset.customer_name || '';
            document.getElementById("customer_address").value = this.dataset.address || '';
            document.getElementById("customer_phone").value = this.dataset.phone || '';
        }

        if (table === "contracts") {
            document.getElementById("contract_id").value = this.dataset.id || '';
            document.getElementById("contract_customer").value = this.dataset.customer_name || '';
            document.getElementById("contract_date").value = this.dataset.contract_date || '';
            document.getElementById("contract_execution").value = this.dataset.execution_date || '';
        }

        if (table === "sales") {
            document.getElementById("sale_id").value = this.dataset.id || '';
            document.getElementById("sale_customer").value = this.dataset.contract_id || '';
            document.getElementById("sale_model").value = this.dataset.model_id || '';
            document.getElementById("sale_quantity").value = this.dataset.quantity || '';
        }

        modal.style.display = "block";
    };
});

document.querySelector(".close").onclick = function () {
    modal.style.display = "none";
};
