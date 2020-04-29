$url = 'https://ta18toose.itmajakas.ee/Hajusrakendused/lemmikAPI/api.php?limit=14';

fetch($url, {mode:'no-cors'})
.then(response=> {
    return response.json()
    
})
.then[paintings => {
    const paintingsDiv = document.getElementById('paintings')

    paintings.forEach(painting => {
        let paintingDiv = painting.createElement('div')
        paintingDiv.classList.add('painting')
        paintingDiv.innerHTML = '<div class="title">' + painting.title + '</div><div class="description">'
        + painting.description + '</div>'
        paintingDiv.append(paintingDiv)
    });
}]