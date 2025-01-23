# Data Design

## **1. Input Data**

### **Description**
The Strategies component receives input data related to the list of available trading strategies, their configurations, and associated performance metrics. This data is used to populate the component's interface and enable users to manage and analyze the strategies.

### **Specification**

- **Structure**:
  ```javascript
  {
    strategies: Array<{
      name: string,
      isActive: boolean,
      isPaused: boolean,
      wallet: "USDT-M" | "USDT-COIN" | "SPOT",
      totalMarginAmount: number,
      averageTradeCount: number,
      stopLoss: number, // Percentage
      takeProfit: number // Percentage
    }>,
    strategyPerformance: Array<{
      name: string,
      totalClosedTrades: number,
      netProfit: number, // Percentage
      percentProfitable: number, // Percentage
      averageTrade: number,
      maxDrawdown: number // Percentage
    }>
  }
  ```

- **Types and Formats**:
  - `strategies`: Array of strategy objects
  - `name`: String representing the strategy name
  - `isActive`: Boolean indicating if the strategy is currently active
  - `isPaused`: Boolean indicating if the strategy is currently paused
  - `wallet`: String enum representing the wallet type
  - `totalMarginAmount`: Number representing the total margin amount per operation
  - `averageTradeCount`: Number representing the average number of trades
  - `stopLoss`: Number representing the stop loss percentage
  - `takeProfit`: Number representing the take profit percentage
  - `strategyPerformance`: Array of strategy performance objects
  - `totalClosedTrades`: Number representing the total number of closed trades
  - `netProfit`: Number representing the net profit percentage
  - `percentProfitable`: Number representing the percentage of profitable trades
  - `averageTrade`: Number representing the average trade value
  - `maxDrawdown`: Number representing the maximum drawdown percentage

- **Validation Rules**:
  - All fields are required, except for `isPaused` which can be `null`.
  - `isActive` and `isPaused` are mutually exclusive (i.e., a strategy cannot be both active and paused).
  - `wallet` must be one of the specified enum values.
  - `totalMarginAmount`, `averageTradeCount`, `stopLoss`, and `takeProfit` must be positive numbers.
  - `netProfit`, `percentProfitable`, and `maxDrawdown` must be within the range of 0 to 100.

## **2. Output Data**

### **Description**
The Strategies component will emit events and update the UI to reflect user interactions and strategy performance changes. This output data can be consumed by other components in the application, such as the Charts and Tables components.

### **Specification**

- **Structure**:
  ```javascript
  {
    activatedStrategy: {
      name: string,
      timestamp: string // ISO 8601 format
    },
    deactivatedStrategy: {
      name: string,
      timestamp: string // ISO 8601 format
    },
    strategyOperations: Array<{
      strategyName: string,
      type: "long" | "short",
      timestamp: string // ISO 8601 format
    }>
  }
  ```

- **Types and Formats**:
  - `activatedStrategy`: Object containing the name and timestamp of the activated strategy
  - `deactivatedStrategy`: Object containing the name and timestamp of the deactivated strategy
  - `strategyOperations`: Array of objects representing the operations performed by a strategy
  - `name`: String representing the strategy name
  - `timestamp`: String in ISO 8601 format representing the date and time of the event
  - `type`: String enum representing the type of operation (long or short)

**Events or Callbacks:**
- `onStrategyActivated(strategy: { name: string, timestamp: string }): void`
- `onStrategyDeactivated(strategy: { name: string, timestamp: string }): void`
- `onStrategyOperation(operation: { strategyName: string, type: "long" | "short", timestamp: string }): void`

## **3. API Integration**

### **Description**
The Strategies component will interact with a backend API to fetch the list of available strategies and their performance data. It will also send requests to the API to activate, pause, or stop strategies.

### **Specification**

**Endpoints**:
- `GET /strategies`
  - Fetches the list of available strategies and their configurations.
- `POST /strategies/{strategyId}/activate`
  - Activates the specified strategy.
- `POST /strategies/{strategyId}/pause`
  - Pauses the specified strategy.
- `POST /strategies/{strategyId}/stop`
  - Stops the specified strategy.

**Headers**:
```http
Authorization: Bearer <token>
```

**Request Example**:
```http
GET /strategies
```

**Response Example**:
```json
{
  "strategies": [
    {
      "name": "BFS strategy",
      "isActive": true,
      "isPaused": false,
      "wallet": "USDT-M",
      "totalMarginAmount": 100,
      "averageTradeCount": 50,
      "stopLoss": 2,
      "takeProfit": 5
    },
    {
      "name": "Trend Following",
      "isActive": false,
      "isPaused": false,
      "wallet": "USDT-COIN",
      "totalMarginAmount": 200,
      "averageTradeCount": 75,
      "stopLoss": 3,
      "takeProfit": 8
    }
  ],
  "strategyPerformance": [
    {
      "name": "BFS strategy",
      "totalClosedTrades": 541,
      "netProfit": 3,
      "percentProfitable": 66,
      "averageTrade": 0.35,
      "maxDrawdown": 0.1
    }
  ]
}
```

**Response Codes**:
- `200 OK`: Successful response.
- `401 Unauthorized`: Invalid or missing token.
- `500 Internal Server Error`: Server-side error.



## **4. Data Handling Optimization (Optional)**

### **Strategies**

1. **Pagination**: Implement pagination on the list of strategies to avoid loading all data at once, especially when the number of strategies grows.
2. **Memoization**: Use techniques like `React.memo` or `useMemo` to memoize the rendering of strategy list items, preventing unnecessary re-renders.
3. **Lazy Loading**: Only load the detailed settings for a strategy when the user clicks the gear icon, to improve the initial load performance.
4. **Error Control**: Ensure all API requests are properly handled, with clear error messages displayed to the user and appropriate fallback behavior.