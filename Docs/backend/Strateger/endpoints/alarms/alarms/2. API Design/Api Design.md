# **API Design for Alarms**

## **2. API Design**

### **Endpoint Details**
- **URL Path**: `/alarms/alarms`
- **HTTP Method**: `GET`

### **Headers**
- `Authorization`: Bearer token for user authentication.
- `Content-Type`: `application/json`.

### **Query Parameters**
- **`limit`**: Maximum number of alarms to retrieve in a single request (integer, minimum 1, default 10).
- **`offset`**: Number of alarms already retrieved, used for pagination (integer, minimum 0, default 0).
- **`latest`**: Boolean flag to retrieve the most recent alarms (`true`, default `false`).

### **Request Body**
Not applicable for this endpoint.

### **Response Schema**
```json
[
    {
        "id": 1,
        "Ticker": "BTCUSDT",
        "Temporalidad": "1m",
        "Quantity": "0.01",
        "Entry_Price_Alert": "50000.00",
        "Exit_Price_Alert": "52000.00",
        "Time_Alert": "2024-11-28T10:00:00Z",
        "Order": "Open Long",
        "Strategy": "StrategyA"
    },
    {
        "id": 2,
        "Ticker": "ETHUSDT",
        "Temporalidad": "5m",
        "Quantity": "0.1",
        "Entry_Price_Alert": "1800.00",
        "Exit_Price_Alert": "1900.00",
        "Time_Alert": "2024-11-28T10:05:00Z",
        "Order": "Close Short",
        "Strategy": "StrategyB"
    }
]
```

### **Response Codes**
- `200 OK: Alarms retrieved successfully.`
- `400 Bad Request: Invalid query parameters.`
- `401 Unauthorized: Invalid or missing authentication token.`
- `403 Forbidden: IP is not allowed to access the service.`
- `500 Internal Server Error: Unexpected server error.`