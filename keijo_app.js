fetch('http://hajusrakendusete-harjutused.herokuapp.com/api/v1/limit=3')
.then(response=> {
	
    return response.json();
    
})
.then(breads => {
	console.log(breads);
    const breadsDiv = document.getElementById('keijo_output');

    breads.forEach(bread => {
        let breadDiv = document.createElement('div');
        breadDiv.classList.add('col-4');
        breadDiv.classList.add('mt-3');

        breadDiv.innerHTML = '<h5>' 
        + bread.title + '</h5><div class="description">' 
        + bread.description + '</div>' 
        + '<div ><img src="'+ bread.img_url +'" width="auto" height="300" class="img-responsive" ></div>';
        breadsDiv.append(breadDiv);
                
    });
})