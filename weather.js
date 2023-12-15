const apiKey = 'c295a98eee95de9db0542cc501ae06d1';

const weatherContainer = document.getElementById("weather");
const error = document.getElementById('error');

async function fetchWeather() {
    try {
        weatherContainer.innerHTML = '';
        error.innerHTML = '';

        const cnt = 1;
        const city = 'London';

        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

        const response = await fetch(apiUrl);
        const data = await response.json();

        // Display error if issue is found
        if (data.cod !== 200) {
            error.innerHTML = `Error retrieving weather data: ${data.message}`;
            return;
        }

        const temp = data.main.temp;
        let message = '';

        if (temp > 30) {
            message = 'It is too hot today. Dont walk, rent a car. ';
        } else if (temp > 20) {
            message = 'The weather is great for driving today in London.';
        } else {
            message = 'Be careful. The weather is not the best for walking today. Better rent a car.';
        }

        weatherContainer.innerHTML = message;

    } catch (error) {
        console.error(error);
        weatherContainer.innerHTML = 'Failed to fetch weather data.';
    }
    document.getElementById('currentTemperature').innerHTML = `Current Temperature: ${temp}°C`;

}

fetchWeather();
