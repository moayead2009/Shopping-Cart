window.addEventListener("load", function() {
	//call functions 
	addCart();
	CartCount();
	
	//set varibles 
	let ff = document.getElementsByClassName("cartValue");
	let addstatus = document.getElementsByClassName("addstatus");	
	let qtyInputs = document.getElementsByClassName("cartQTYInput");
	let priceQTYTitle = document.getElementsByClassName("priceQTYTitle");
	
	
	
    for (var i = 0; i < qtyInputs.length; i++) {
        qtyInputs[i].addEventListener('change', quantityChanged)
    }
	/**
	 *  @brief if user inserts lest than 1, make it 1
	 *  
	 *  @param [event] 
	 */
	function quantityChanged(event) {
		if(isNaN(event.target.value) || event.target.value <= 0) {
			event.target.value = 1
		}
	}
	/**
	 *  @brief reload the page
	 *  
	 */
	function updateCartTotal(r){
		window.location.reload();
	}
	deleteItem();
	/**
	 *  @brief delete items from the cart
	 *  
	 */
	function deleteItem(){
		let allDeleteItems = document.getElementsByClassName("cartRemoveInput");
		for(let i = 0; i < allDeleteItems.length; i++){
			let itemID = allDeleteItems[i].getAttribute("data-CartItemid");
			allDeleteItems[i].addEventListener('click', function () {
				let url  = "itemid=" + itemID;
				fetch("delete.php", {
						method: 'POST',
						credentials: 'include',
						headers: { "Content-Type": "application/x-www-form-urlencoded" },
						body: url
					})	
					.then(response => response.text())
					.then(updateCartTotal)
			});
		}
	}
	updateItem();
	/**
	 *  @brief update items of the cart ( QTY )
	 *  
	 */
	function updateItem(){
		let updateItems = document.getElementsByClassName("cartQTYupdateInput");
		let ItemVlaus = document.getElementsByClassName("cartQTYInput");
		for(let i = 0; i < updateItems.length; i++){
			let itemID = ItemVlaus[i].getAttribute("data-itemValueId");
			updateItems[i].addEventListener('click', function () {
				let itemValue = ItemVlaus[i].value;
				let url  = "itemid=" + itemID + "&cart=" + itemValue;
				fetch("update.php", {
						method: 'POST',
						credentials: 'include',
						headers: { "Content-Type": "application/x-www-form-urlencoded" },
						body: url
					})	
					.then(response => response.text())
					.then(updateCartTotal)
			});
		}
	}
	
	/**
	 *  @brief check if the items on the cart or not
	 *  
	 */
	function CartCount(data){
		console.log(data);
		if(data === 7){
			addstatus[0].innerHTML = "This item is already added in the cart ..";
			addstatus[0].style.backgroundColor = "red";
			addstatus[0].style.display = "block";
			$(".addstatus").fadeOut(1500);
		}else if(data === 8){
			addstatus[0].innerHTML = "Item has been added to your cart";
			addstatus[0].style.display = "block";
			$(".addstatus").fadeOut(1500);
		}
	
		
				
		fetch("../server/showCartN.php", {
				method: 'POST',
				credentials: 'include',
				headers: { "Content-Type": "application/x-www-form-urlencoded" },
			})	
			.then(response => response.json())
			.then(function d(t){
				ff[0].innerHTML = t;
				priceQTYTitle[0].innerHTML = "Price (" + t + " items)";
			})		
	}
	
	/**
	 *  @brief add items to the cart
	 *  
	 */
	function addCart(){
		let allItems = document.querySelectorAll('[data-itemid]');
		for(let i = 0; i < allItems.length; i++){
			let itemid = allItems[i].getAttribute("data-itemid");
			allItems[i].addEventListener('click', function () {
				let url  = "itemid=" + itemid;
				fetch("../server/cart.php?", {
						method: 'POST',
						credentials: 'include',
						headers: { "Content-Type": "application/x-www-form-urlencoded" },
						body: url
					})					
					.then(response => response.json())
					.then(CartCount)
			});
		}
	}
	
	
	
	

}); 