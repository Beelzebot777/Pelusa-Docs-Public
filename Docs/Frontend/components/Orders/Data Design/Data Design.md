# Data Design

## **1. Input Data**

### **Description**
The component receives data related to executed orders in the BingX exchange. This data will be used to visualize the orders on the main chart, display relevant information in a table, and analyze the hourly distribution of orders in a Radar-Chart.

### **Specification**

- **Structure**: The input data is expected to be an array of order objects, with each object containing the following properties:
  - `orderId`: a unique identifier for the order
  - `symbol`: the stock/cryptocurrency ticker symbol
  - `side`: the type of operation (buy or sell)
  - `leverage`: the leverage used (for margin orders only)
  - `type`: the type of order (market, limit, stop, etc.)
  - `positionSide`: the position taken (long or short)
  - `reduceOnly`: a flag indicating if the order is to reduce position only
  - `quantity`: the amount of assets traded
  - `price`: the price at which the order was executed
  - `averagePrice`: the average execution price
  - `status`: the status of the order (open, closed, canceled, etc.)
  - `profit`: the profit or loss of the order (in the account currency)
  - `commission`: the commission charged for the order
  - `stopPrice`: the trigger price for a stop order
  - `workingType`: the market order type (market, limit, stop, etc.)
  - `time`: the timestamp of the order execution
  - `updateTime`: the timestamp of the last order update

- **Types and Formats**:
  - `orderId`: number
  - `symbol`: string
  - `side`: string ("buy" | "sell")
  - `leverage`: number (for margin orders only)
  - `type`: string ("market" | "limit" | "stop" | "take-profit" | "stop-loss")
  - `positionSide`: string ("long" | "short")
  - `reduceOnly`: boolean
  - `quantity`: number
  - `price`: number
  - `averagePrice`: number
  - `status`: string ("open" | "closed" | "canceled" | "partially-filled")
  - `profit`: number (in the account currency)
  - `commission`: number (in the account currency)
  - `stopPrice`: number
  - `workingType`: string ("market" | "limit" | "stop" | "take-profit" | "stop-loss")
  - `time`: string (ISO 8601 format)
  - `updateTime`: string (ISO 8601 format)

- **Validation Rules**:
  - All properties are required and cannot be null or undefined.
  - `orderId` must be a unique positive integer.
  - `symbol` must be a non-empty string.
  - `side` must be either "buy" or "sell".
  - `leverage` must be a positive number (for margin orders only).
  - `type` must be one of the valid values.
  - `positionSide` must be either "long" or "short".
  - `reduceOnly` must be a boolean.
  - `quantity` must be a positive number.
  - `price` and `averagePrice` must be positive numbers.
  - `status` must be one of the valid values.
  - `profit` and `commission` can be positive or negative numbers.
  - `stopPrice` must be a positive number.
  - `workingType` must be one of the valid values.
  - `time` and `updateTime` must be valid ISO 8601 format strings.

#### **Example**
```javascript
{
  orders: [
    {
      orderId: 1234,
      symbol: "BTC-USD",
      side: "buy",
      leverage: 10,
      type: "market",
      positionSide: "long",
      reduceOnly: false,
      quantity: 0.1,
      price: 50000.00,
      averagePrice: 50000.00,
      status: "closed",
      profit: 500,
      commission: 5,
      stopPrice: 49000,
      workingType: "market",
      time: "2023-04-01T10:00:00Z",
      updateTime: "2023-04-01T10:00:10Z"
    },
    {
      orderId: 5678,
      symbol: "ETH-USD",
      side: "sell",
      leverage: 20,
      type: "limit",
      positionSide: "short",
      reduceOnly: true,
      quantity: 2,
      price: 1800.50,
      averagePrice: 1805.00,
      status: "open",
      profit: -100,
      commission: 2,
      stopPrice: 1810,
      workingType: "limit",
      time: "2023-04-01T10:15:00Z",
      updateTime: "2023-04-01T10:15:30Z"
    }
  ]
}
```

---

## **2. Output Data**

### **Description**
The component will output the following data:

1. **Markers for the Main Chart**: Markers to be displayed on the main candlestick chart, representing the executed orders.
2. **Order Table Data**: The order data in a tabular format, with filtering and sorting capabilities.
3. **Radar-Chart Data**: The hourly distribution of orders to be displayed in the Radar-Chart.

### **Specification**

- **Markers for the Main Chart**:
  - `orderId`: the unique identifier of the order
  - `symbol`: the stock/cryptocurrency ticker symbol
  - `time`: the timestamp of the order execution
  - `side`: the type of order (buy or sell)
  - `price`: the price at which the order was executed
  - `strategy`: the trading strategy or wallet used for the order

- **Order Table Data**:
  - `orderId`: the unique identifier of the order
  - `symbol`: the stock/cryptocurrency ticker symbol
  - `side`: the type of operation (buy or sell)
  - `leverage`: the leverage used (for margin orders only)
  - `type`: the type of order
  - `positionSide`: the position taken (long or short)
  - `reduceOnly`: a flag indicating if the order is to reduce position only
  - `quantity`: the amount of assets traded
  - `price`: the price at which the order was executed
  - `averagePrice`: the average execution price
  - `status`: the status of the order
  - `profit`: the profit or loss of the order (in the account currency)
  - `commission`: the commission charged for the order
  - `stopPrice`: the trigger price for a stop order
  - `workingType`: the market order type
  - `time`: the timestamp of the order execution
  - `updateTime`: the timestamp of the last order update

- **Radar-Chart Data**:
  - `hour`: the hour of the day (0-23)
  - `count`: the number of orders executed during that hour

**Events or Callbacks:**
- `onMarkerClick(marker: { orderId: number, symbol: string, time: string, side: string, price: number, strategy: string }): void`
  - Triggered when a user clicks on a marker in the main chart.
- `onFilterApplied(filters: { symbol?: string, side?: string, type?: string, positionSide?: string, status?: string }): void`
  - Triggered when the user applies filters to the order table.

#### **Example**

```javascript
{
  markers: [
    {
      orderId: 1234,
      symbol: "BTC-USD",
      time: "2023-04-01T10:00:00Z",
      side: "buy",
      price: 50000.00,
      strategy: "Long-term Hodl"
    },
    {
      orderId: 5678,
      symbol: "ETH-USD",
      time: "2023-04-01T10:15:00Z",
      side: "sell",
      price: 1800.50,
      strategy: "Day Trading"
    }
  ],
  tableData: [
    {
      orderId: 1234,
      symbol: "BTC-USD",
      side: "buy",
      leverage: 10,
      type: "market",
      positionSide: "long",
      reduceOnly: false,
      quantity: 0.1,
      price: 50000.00,
      averagePrice: 50000.00,
      status: "closed",
      profit: 500,
      commission: 5,
      stopPrice: 49000,
      workingType: "market",
      time: "2023-04-01T10:00:00Z",
      updateTime: "2023-04-01T10:00:10Z"
    },
    {
      orderId: 5678,
      symbol: "ETH-USD",
      side: "sell",
      leverage: 20,
      type: "limit",
      positionSide: "short",
      reduceOnly: true,
      quantity: 2,
      price: 1800.50,
      averagePrice: 1805.00,
      status: "open",
      profit: -100,
      commission: 2,
      stopPrice: 1810,
      workingType: "limit",
      time: "2023-04-01T10:15:00Z",
      updateTime: "2023-04-01T10:15:30Z"
    }
  ],
  radarChartData: [
    { hour: 0, count: 5 },
    { hour: 1, count: 3 },
    // More hourly data
  ]
}
```

---

## **3. API Integration**

### **Description**
The component will fetch the order data from a BingX API using Redux Toolkit's `createAsyncThunk` functionality. It will use this data to populate the main chart, order table, and Radar-Chart.

### **Specification**

**Endpoints**:
- USDTM Orders: `GET /bingx/usdtm/get-all-full-orders`
- COINM Orders: `GET /bingx/coinm/query-history-orders`
- Spot Orders: `GET /bingx/spot/get-order-history`
- Standard Orders: `GET /bingx/standard/query-historical-orders`

**Parameters**:
- `limit`: the number of orders to fetch per request
- `offset`: the offset for pagination
- `startDate`: the start date for filtering orders (optional)
- `endDate`: the end date for filtering orders (optional)

**Headers**:
```http
Authorization: Bearer <token>
```

**Response Structure**:
- USDTM Orders:
  ```javascript
  {
    data: {
      orders: [
        // Order objects
      ]
    }
  }
  ```
- COINM Orders:
  ```javascript
  {
    data: {
      orders: [
        // Order objects  
      ]
    }
  }
  ```
- Spot Orders:
  ```javascript
  {
    data: {
      orders: [
        // Order objects
      ]
    }
  }
  ```
- Standard Orders:
  ```javascript
  {
    data: [
      // Order objects
    ]
  }
  ```

**Security**:
The API requires a valid Bearer token for authentication. The token should be obtained and managed by the application.

**Error Handling**:
The component should gracefully handle network errors, authentication issues, and any invalid data returned by the API. Appropriate error messages and fallback data should be displayed to the user.

**Redux Thunk Actions**:
The component will use the following Redux Toolkit actions to fetch the order data:

```javascript
import { createAsyncThunk } from '@reduxjs/toolkit';
import axios from 'axios';
import { config } from '../../config';

export const fetchOrdersUsdtm = createAsyncThunk(
  'orders/fetchOrdersUsdtm',
  async ({ limit, offset, startDate, endDate }) => {
    const params = { limit, offset };
    if (startDate) params.startDate = startDate;
    if (endDate) params.endDate = endDate;

    const response = await axios.get(`${config.apiURL}/bingx/usdtm/get-all-full-orders`, { params });
    const data = JSON.parse(response.data);

    if (data && data.data && data.data.orders) {
      return data.data.orders;
    } else {
      throw new Error('Invalid response structure');
    }
  }
);

export const fetchOrdersCoinm = createAsyncThunk(
  'orders/fetchOrderCoinm',
  async ({ limit, offset, startDate, endDate }) => {
    const params = { limit, offset };
    if (startDate) params.startDate = startDate;
    if (endDate) params.endDate = endDate;

    const response = await axios.get(`${config.apiURL}/bingx/coinm/query-history-orders`, { params });
    const data = JSON.parse(response.data);

    if (data && data.data && data.data.orders) {
      return data.data.orders;
    } else {
      throw new Error('Invalid response structure');
    }
  }
);

export const fetchOrdersSpot = createAsyncThunk(
  'orders/fetchOrderSpot',
  async ({ limit, offset, startDate, endDate }) => {
    const params = { limit, offset };
    if (startDate) params.startDate = startDate;
    if (endDate) params.endDate = endDate;

    const response = await axios.get(`${config.apiURL}/bingx/spot/get-order-history`, { params });
    const data = JSON.parse(response.data);

    if (data && data.data && data.data.orders) {
      return data.data.orders;
    } else {
      throw new Error('Invalid response structure');
    }
  }
);

export const fetchOrdersStandard = createAsyncThunk(
  'orders/fetchOrderStandard',
  async ({ limit, offset, startDate, endDate }) => {
    const params = { limit, offset };
    if (startDate) params.startDate = startDate;
    if (endDate) params.endDate = endDate;

    const response = await axios.get(`${config.apiURL}/bingx/standard/query-historical-orders`);
    const data = JSON.parse(response.data);

    if (data && data.data) {
      return data.data;
    } else {
      throw new Error('Invalid response structure');
    }
  }
);
```

The component can use these Redux Toolkit actions to fetch the order data and handle the responses accordingly.