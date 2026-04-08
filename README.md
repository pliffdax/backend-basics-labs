# Laboratory work #4 - Weather App

Web application on Node.js and Express for receiving weather data from OpenWeatherMap and displaying it with EJS templates.

## Features

- home page and weather page
- menu with predefined cities
- route in the format `/weather/:city`
- support for query string `/weather?city=Kyiv`
- weather by current user location through `/weather/?lat=...&lon=...`
- JSON route `/weather/api/:city`
- error page for incorrect requests

## Requirements

- Node.js 20+
- pnpm or npm
- OpenWeatherMap API key

## Installation

```bash
pnpm install
```

Create `.env` in the project root:

```env
OPENWEATHER_API_KEY=your_api_key_here
PORT=3000
```

## Run

```bash
pnpm start
```

For development mode:

```bash
pnpm dev
```

## Main routes

- `/` - home page
- `/weather` - city selection page
- `/weather/Kyiv` - weather for selected city
- `/weather?city=Kyiv` - weather through query parameter
- `/weather/?lat=50.45&lon=30.52` - weather for current location
- `/weather/api/Kyiv` - JSON response
