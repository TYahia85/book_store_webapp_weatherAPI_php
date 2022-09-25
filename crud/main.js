// Weather API
let weather = {
    API_KEY: "95979ded7becff0834db0c708ecc57d0",
    fetchWeather: function(city){
        fetch("https://api.openweathermap.org/data/2.5/weather?q="
        +city
        +"&appid="
        +this.API_KEY)
        .then((response) => response.json())
        .then((data) => this.displayWeather(data));
    },
    displayWeather: function(data){
        const {name} = data;
        const {icon,description} = data.weather[0];
        const {temp,humidity} = data.main;
        const {speed} = data.wind;
        console.log(name,icon,description,temp,humidity,speed);
        document.querySelector("#icon").src = "https://openweathermap.org/img/wn/" + icon + "@2x.png";
        document.querySelector("#city").innerText = " Weather in "+name+":";
        document.querySelector("#description").innerText = description+" ";
        document.querySelector("#temp").innerText = temp + "(F)";
        document.querySelector("#humidity").innerText = "  Humidity: " + humidity;
        document.querySelector("#speed").innerText = "  Wind Speed: " + speed + " km/h";
    },
    searchWeather: function(){
        this.fetchWeather(document.querySelector("#search-input").value);
    }

}

document.querySelector("#search").addEventListener("click", function(){

    weather.searchWeather();
});


//Book store functions**********************

//Edit function
$(".btn-edit").click(e=>{
    let id = 0;
    let textvalues = [];
    const td = $("tbody tr td");
    for(const value of td){
        if(value.dataset.id == e.target.dataset.id){
            textvalues[id++] = value.textContent;

            let bookid = $("input[name*='book-id']");
            let bookname = $("input[name*='book-name']");
            let bookpublisher = $("input[name*='book-publisher']");
            let bookprice = $("input[name*='book-price']");

            bookid.val(textvalues[0]);
            bookname.val(textvalues[1]);
            bookpublisher.val(textvalues[2]);
            bookprice.val(textvalues[3]);

        }
    }

});

// function displayData(e){
//     let id = 0;
//     const td = $("tbody tr td");
//     let textvalues = [];

//     for(const value of td){
//         console.log(value);
//         // if(value.dataset.id == e.target.dataset.id){
//         //     textvalues[id++] = value.textContent;
//         }
//     }
//     // return textvalues;
// }