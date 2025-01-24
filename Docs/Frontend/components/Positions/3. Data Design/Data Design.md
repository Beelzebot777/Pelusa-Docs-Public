# Data Design

## **1. Input Data**

### **Description**
The component "Positions" requires trading position data from multiple sources, including the Redux store and API responses. This data is used to populate charts, tables, and actionable elements like SL/TP configuration.

### **Specification**

- **Structure**:
  ```javascript
  {
    positions: Array<{
      id: string, // Unique identifier for the position
      ticker: string, // Symbol of the traded asset (e.g., BTC/USDT)
      wallet: string, // Wallet or subaccount identifier
      margin: number, // Margin used for the position
      leverage: number, // Leverage applied
      pnl: number, // Profit and loss in USD
      sl: number | null, // Stop Loss value, if set
      tp: number | null, // Take Profit value, if set
      liquidationPrice: number, // Price at which the position will be liquidated
      entryPrice: number, // Entry price of the position
      size: number, // Size of the position
      time: string // ISO 8601 format timestamp for position creation
    }>
  }
  ```

- **Types and Formats**:
  - **id**: `string`, mandatory.
  - **ticker**: `string`, mandatory, formatted as `ASSET/QUOTE` (e.g., BTC/USDT).
  - **wallet**: `string`, mandatory, representing a specific wallet or subaccount.
  - **margin**: `number`, mandatory, must be greater than 0.
  - **leverage**: `number`, mandatory, valid range 1-100.
  - **pnl**: `number`, mandatory, can be positive or negative.
  - **sl**: `number | null`, optional.
  - **tp**: `number | null`, optional.
  - **liquidationPrice**: `number`, mandatory.
  - **entryPrice**: `number`, mandatory.
  - **size**: `number`, mandatory, must be greater than 0.
  - **time**: `string`, mandatory, ISO 8601 format (e.g., "2025-01-18T10:00:00Z").

- **Validation Rules**:
  - **id**: Must be unique and non-empty.
  - **ticker**: Must match a predefined list of valid trading pairs.
  - **margin, leverage, size**: Must be positive numbers.
  - **sl, tp**: Optional but must be positive if provided.

---

## **2. Output Data**

### **Description**
The "Positions" component emits data related to user actions, such as updates to SL/TP values, and displays position summaries for external use.

### **Specification**

- **Structure**:
  ```javascript
  {
    updatedPosition: {
      id: string, // Unique identifier for the position
      sl: number, // Updated Stop Loss value
      tp: number // Updated Take Profit value
    },
    positionSummary: {
      totalPnl: number, // Aggregated Profit and Loss
      totalPositions: number // Number of open positions
    }
  }
  ```

- **Types and Formats**:
  - **updatedPosition**: Emitted when a user updates SL or TP values.
    - **id**: `string`, mandatory.
    - **sl**: `number`, mandatory, must be positive.
    - **tp**: `number`, mandatory, must be positive.
  - **positionSummary**: Provided for dashboard-level metrics.
    - **totalPnl**: `number`, mandatory, aggregated PNL.
    - **totalPositions**: `number`, mandatory, must be non-negative.

- **Events or Callbacks**:
  - **onPositionUpdate(position: updatedPosition): void**
  - **onSummaryUpdate(summary: positionSummary): void**

---

## **3. API Integration**

### **Description**
The component interacts with APIs to fetch and update position data. It ensures secure, real-time communication for accurate data representation.

### **Specification**

- **Endpoints**:
  - **Fetch Positions**:
    - **Method**: `GET`
    - **Endpoint**: `/positions`
    - **Headers**: `Authorization: Bearer <token>`
    - **Response**:
      ```json
      {
        "positions": [
          {
            "id": "1",
            "ticker": "BTC/USDT",
            "wallet": "main-wallet",
            "margin": 100,
            "leverage": 10,
            "pnl": 50,
            "sl": 150,
            "tp": 200,
            "liquidationPrice": 25000,
            "entryPrice": 30000,
            "size": 0.01,
            "time": "2025-01-18T10:00:00Z"
          }
        ]
      }
      ```

  - **Update Position**:
    - **Method**: `POST`
    - **Endpoint**: `/positions/update`
    - **Body**:
      ```json
      {
        "id": "1",
        "sl": 150,
        "tp": 200
      }
      ```
    - **Response**:
      ```json
      {
        "success": true,
        "message": "Position updated successfully"
      }
      ```

- **Security**:
  - Use Bearer tokens for authentication.
  - Validate all input data server-side.

- **Error Handling**:
  - **401 Unauthorized**: Invalid token.
  - **400 Bad Request**: Missing or invalid parameters.
  - **500 Internal Server Error**: Unexpected server issues.

---

## **4. Data Flow Diagram (Optional)**

### **Description**
The data flow starts from API responses, flows through Redux, and ends in UI updates. User interactions trigger updates sent back to the API.

1. **Input**: API fetches and Redux state.
2. **Processing**: Data filtering, sorting, and mapping for charts and tables.
3. **Output**: UI updates and API requests for SL/TP adjustments.

---

## **5. Data Handling Optimization (Optional)**

### **Strategies**
- **Pagination**: Fetch positions in chunks to prevent overloading the UI.
- **Memoization**: Cache filtered/sorted data for repeated use.
- **Error Control**: Display error messages for failed API requests to guide user actions.

