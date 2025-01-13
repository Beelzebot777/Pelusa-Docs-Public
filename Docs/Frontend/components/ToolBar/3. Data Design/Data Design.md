# Data Design: ToolBar Component

---

## **Input Data**
The `ToolBar` component receives the following input data, required for its proper functioning:

### 1. **Tickers**
- **Type**: `Array<Ticker>`  
- **Format**:
  ```json
  [
    {
      "id": "BTCUSD",
      "name": "Bitcoin/USD"
    },
    {
      "id": "ETHUSD",
      "name": "Ethereum/USD"
    }
  ]
  ```
- **Purpose**: Provides the list of available tickers for the `Tickers Button` dropdown.

### 2. **Intervals**
- **Type**: `Array<string>`  
- **Format**:
  ```json
  ["1m", "5m", "15m", "30m", "1h", "4h", "1d", "1w", "1M"]
  ```
- **Purpose**: Defines the available time intervals for the `Intervals Panel`.

### 3. **Indicators**
- **Type**: `Array<Indicator>`  
- **Format**:
  ```json
  [
    {
      "id": "EMA",
      "name": "Exponential Moving Average"
    },
    {
      "id": "Stochastic",
      "name": "Stochastic Oscillator"
    }
  ]
  ```
- **Purpose**: Provides the list of available indicators for the `Indicators` dropdown.

### 4. **Market Times**
- **Type**: `Array<MarketTime>`  
- **Format**:
  ```json
  [
    {
      "region": "USA",
      "opening": "09:30",
      "closing": "16:00"
    },
    {
      "region": "Germany",
      "opening": "08:00",
      "closing": "17:00"
    },
    {
      "region": "China",
      "opening": "09:30",
      "closing": "15:00"
    }
  ]
  ```
- **Purpose**: Provides the opening and closing hours of major financial markets for the `Clock` dropdown.

---

## **Output Data**
The `ToolBar` component emits the following events or data, which are consumed by other components such as `Charts`:

### 1. **Selected Ticker**
- **Type**: `string`  
- **Format**:
  ```json
  "BTCUSD"
  ```
- **Purpose**: Represents the currently selected financial ticker. This is used by the `Charts` component to update the displayed data.

### 2. **Selected Interval**
- **Type**: `string`  
- **Format**:
  ```json
  "1h"
  ```
- **Purpose**: Represents the currently selected time interval. The `Charts` component uses this to adjust the granularity of the data displayed.

### 3. **Selected Indicators**
- **Type**: `Array<string>`  
- **Format**:
  ```json
  ["EMA", "Stochastic"]
  ```
- **Purpose**: Represents the list of active indicators. The `Charts` component uses this to overlay the selected indicators on the graph.

### 4. **JumpToTime**
- **Type**: `string` (ISO 8601 format)  
- **Format**:
  ```json
  "2025-01-01T12:00:00Z"
  ```
- **Purpose**: Indicates the timestamp to which the chart should jump. The `Charts` component uses this to scroll to the specified point in time.


