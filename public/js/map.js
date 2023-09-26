var mapDiv = document.getElementById("map");

function showmap(address)
{
    mapURL = "https://maps.google.com.tw/maps?f=q&hl=zh-TW&geocode=&q=" + address + "&z=16&output=embed&t=";
    mapDiv.innerHTML = '<iframe src="' + mapURL + '" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
}