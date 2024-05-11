<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script>
	$('.process').change(function(){
		const value = $($this).val();
		const order_code = $($this).find(':selected').attr('id');
		alert(order_code);
		if(value == 0){
			alert('please choose option for order');
		}else{
			$.ajax({
				method:'POST',
				url:'order/process',
				data: {value:value, order_code:order_code},
				success:function(){
					alert('thay đổi thuộc tính thành công');
				}
			})
		}
	})
</script>
</body>
</html>
