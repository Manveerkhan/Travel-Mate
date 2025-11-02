document.addEventListener('DOMContentLoaded', function () {
	const searchForms = document.querySelectorAll('[data-search-form]');
	searchForms.forEach(f => {
		f.addEventListener('submit', (e) => {
			const q = f.querySelector('input[name="q"]').value.trim();
			if (!q) {
				e.preventDefault();
			}
		});
	});

	// Weather Widget - Using Open-Meteo (Free API, no key required)
	const weatherBtn = document.getElementById('weather-btn');
	const weatherCity = document.getElementById('weather-city');
	const weatherResult = document.getElementById('weather-result');

	if (weatherBtn && weatherCity && weatherResult) {
		// First, get coordinates from city name using Geocoding API, then fetch weather
		const GEOCODING_API = 'https://geocoding-api.open-meteo.com/v1/search';
		const WEATHER_API = 'https://api.open-meteo.com/v1/forecast';

		function getWeatherIcon(code) {
			// Map weather codes to emojis/icons
			const icons = {
				'clear': '☀️',
				'sunny': '☀️',
				'partly-cloudy': '⛅',
				'cloudy': '☁️',
				'overcast': '☁️',
				'fog': '🌫️',
				'drizzle': '🌦️',
				'rain': '🌧️',
				'freezing-rain': '🌨️',
				'snow': '❄️',
				'thunderstorm': '⛈️',
			};
			return icons[code] || '🌤️';
		}

		function getWeatherCodeDescription(code) {
			const descriptions = {
				0: 'Clear sky',
				1: 'Mainly clear',
				2: 'Partly cloudy',
				3: 'Overcast',
				45: 'Foggy',
				48: 'Depositing rime fog',
				51: 'Light drizzle',
				53: 'Moderate drizzle',
				55: 'Dense drizzle',
				56: 'Light freezing drizzle',
				57: 'Dense freezing drizzle',
				61: 'Slight rain',
				63: 'Moderate rain',
				65: 'Heavy rain',
				66: 'Light freezing rain',
				67: 'Heavy freezing rain',
				71: 'Slight snow fall',
				73: 'Moderate snow fall',
				75: 'Heavy snow fall',
				77: 'Snow grains',
				80: 'Slight rain showers',
				81: 'Moderate rain showers',
				82: 'Violent rain showers',
				85: 'Slight snow showers',
				86: 'Heavy snow showers',
				95: 'Thunderstorm',
				96: 'Thunderstorm with slight hail',
				99: 'Thunderstorm with heavy hail'
			};
			return descriptions[code] || 'Unknown';
		}

		function fetchWeather(city) {
			if (!city) {
				weatherResult.innerHTML = '<div class="alert alert-warning mb-0">Please enter a city name.</div>';
				return;
			}

			weatherResult.innerHTML = '<div class="text-center"><div class="spinner-border spinner-border-sm text-primary" role="status"></div> <span class="ms-2">Loading weather...</span></div>';

			// Step 1: Get coordinates from city name
			fetch(`${GEOCODING_API}?name=${encodeURIComponent(city)}&count=1&language=en&format=json`)
				.then(response => {
					if (!response.ok) {
						throw new Error('Failed to fetch location data');
					}
					return response.json();
				})
				.then(data => {
					if (!data.results || data.results.length === 0) {
						throw new Error('City not found. Please check the spelling and try again.');
					}

					const location = data.results[0];
					const latitude = location.latitude;
					const longitude = location.longitude;
					const cityName = location.name;
					const country = location.country || '';

					// Step 2: Fetch weather data using coordinates
					return fetch(`${WEATHER_API}?latitude=${latitude}&longitude=${longitude}&current=temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m,apparent_temperature&timezone=auto`)
						.then(response => {
							if (!response.ok) {
								throw new Error('Failed to fetch weather data');
							}
							return response.json();
						})
						.then(weatherData => {
							const current = weatherData.current;
							const temp = Math.round(current.temperature_2m);
							const feelsLike = Math.round(current.apparent_temperature);
							const humidity = current.relative_humidity_2m;
							const windSpeed = Math.round(current.wind_speed_10m);
							const weatherCode = current.weather_code;
							const description = getWeatherCodeDescription(weatherCode);
							const icon = getWeatherIcon(description.toLowerCase().split(' ')[0]);

							const now = new Date();
							const dateString = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
							
							weatherResult.innerHTML = `
								<div class="weather-card p-3 bg-light rounded">
									<div class="d-flex align-items-center justify-content-between mb-3">
										<div>
											<h5 class="mb-1 fw-bold">${cityName}${country ? ', ' + country : ''}</h5>
											<p class="text-muted small mb-0">${dateString}</p>
										</div>
										<div class="text-end">
											<div class="display-4 mb-0">${icon}</div>
										</div>
									</div>
									<div class="row g-3">
										<div class="col-6">
											<div class="text-center p-2 bg-white rounded">
												<div class="h3 mb-1 fw-bold text-primary">${temp}°C</div>
												<small class="text-muted">Temperature</small>
											</div>
										</div>
										<div class="col-6">
											<div class="text-center p-2 bg-white rounded">
												<div class="h5 mb-1 fw-bold">${feelsLike}°C</div>
												<small class="text-muted">Feels like</small>
											</div>
										</div>
									</div>
									<div class="mt-3 pt-3 border-top">
										<div class="row text-center">
											<div class="col-4">
												<div class="small text-muted">Condition</div>
												<div class="fw-semibold text-capitalize">${description}</div>
											</div>
											<div class="col-4">
												<div class="small text-muted">Humidity</div>
												<div class="fw-semibold">${humidity}%</div>
											</div>
											<div class="col-4">
												<div class="small text-muted">Wind</div>
												<div class="fw-semibold">${windSpeed} km/h</div>
											</div>
										</div>
									</div>
								</div>
							`;
						});
				})
				.catch(error => {
					weatherResult.innerHTML = `<div class="alert alert-danger mb-0"><strong>Error:</strong> ${error.message}</div>`;
				});
		}

		weatherBtn.addEventListener('click', () => {
			const city = weatherCity.value.trim();
			if (city) {
				fetchWeather(city);
			} else {
				weatherResult.innerHTML = '<div class="alert alert-warning mb-0">Please enter a city name.</div>';
			}
		});

		weatherCity.addEventListener('keypress', (e) => {
			if (e.key === 'Enter') {
				weatherBtn.click();
			}
		});

		// Load default city weather on page load
		if (weatherCity.value && weatherCity.value.trim()) {
			fetchWeather(weatherCity.value.trim());
		}
	}
});
