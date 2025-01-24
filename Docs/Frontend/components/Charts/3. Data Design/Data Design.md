### **Data Design for the `Charts` Component**

---

## **1. Input Data**

### **Description**
The `Charts` component processes and visualizes trading-related data, such as alarms, orders, positions, diary entries, news, and earnings. It also includes interactive tools and technical analysis capabilities.

### **Specification**

#### **General Structure**
```javascript
{
  alarms: Array<{
    id: number,
    ticker: string,
    interval: "1m" | "5m" | "15m" | "30m" | "1h" | "4h" | "D" | "W" | "M",
    price: number,
    time: string, // ISO 8601
    type: "Open Long" | "Close Long" | "Open Short" | "Close Short",
    strategy: string
  }>,
  orders: Array<{
    id: number,
    ticker: string,
    quantity: number,
    price: number,
    time: string, // ISO 8601
    type: "Buy" | "Sell",
    status: "Pending" | "Executed" | "Cancelled"
  }>,
  positions: Array<{
    id: number,
    ticker: string,
    entryPrice: number,
    exitPrice?: number,
    quantity: number,
    pnl: number, // Profit and Loss
    time: string // ISO 8601
  }>,
  diary: Array<{
    id: number,
    title: string,
    content: string,
    time: string // ISO 8601
  }>,
  news: Array<{
    id: number,
    title: string,
    description: string,
    source: string,
    time: string // ISO 8601
  }>,
  earnings: Array<{
    id: number,
    ticker: string,
    date: string // ISO 8601
  }>,
  markers: Array<{
    time: number, // Time in Unix format (seconds since Epoch)
    position: "aboveBar" | "belowBar" | "inBar", // Relative position on the chart
    color: string, // Marker color
    shape: "circle" | "square" | "arrowUp" | "arrowDown", // Marker shape
    text: string // Additional information displayed on the marker
  }>,
  tools: Array<{
    id: string, // Unique identifier for the tool
    name: string, // Descriptive name of the tool
    icon: string, // Reference to the visual icon
    action: "click" | "drawLine" | "brush" | "drawText" | "drawRectangle" | "measure" | "deleteElements", // Action performed by the tool
    description: string // Description of the functionality
  }>
}
```

#### **Types and Formats**
1. **Alarms**:
   - Represent alarms configured for specific values.
   - Keys:
     - `id`: Unique number.
     - `ticker`: Currency or symbol.
     - `interval`: Time interval.
     - `price`: Activation price.
     - `time`: ISO 8601.
     - `type`: Operation type (e.g., `Open Long`, `Close Short`).
     - `strategy`: Associated strategy.

2. **Orders**:
   - Represent orders placed in the market.
   - Keys:
     - `id`: Unique number.
     - `ticker`: Currency or symbol.
     - `quantity`: Traded quantity.
     - `price`: Execution price.
     - `time`: ISO 8601.
     - `type`: `Buy` or `Sell`.
     - `status`: Order status (`Pending`, `Executed`, `Cancelled`).

3. **Positions**:
   - Represent open or closed positions.
   - Keys:
     - `id`: Unique number.
     - `ticker`: Currency or symbol.
     - `entryPrice`: Entry price.
     - `exitPrice`: Exit price (optional).
     - `quantity`: Traded quantity.
     - `pnl`: Profit or loss (`Profit and Loss`).
     - `time`: ISO 8601.

4. **Diary**:
   - Represents trading diary entries.
   - Keys:
     - `id`: Unique number.
     - `title`: Entry title.
     - `content`: Descriptive content.
     - `time`: ISO 8601.

5. **News**:
   - Represents trading-related news.
   - Keys:
     - `id`: Unique number.
     - `title`: News title.
     - `description`: Brief description.
     - `source`: News source.
     - `time`: ISO 8601.

6. **Earnings**:
   - Represents earnings information related to certain tickers.
   - Keys:
     - `id`: Unique number.
     - `ticker`: Currency or symbol.
     - `date`: Date of the earnings in ISO 8601.

7. **Markers**:
   - Represent interactive elements drawn on the chart.
   - Keys:
     - `time`: Time in Unix format (e.g., `Math.floor(new Date(order.time).getTime() / 1000)`).
     - `position`: Relative position on the chart:
       - `"aboveBar"`: Above the bar.
       - `"belowBar"`: Below the bar.
       - `"inBar"`: Inside the bar.
     - `color`: Hexadecimal color code or color name (e.g., `#FF5733` or `red`).
     - `shape`: Marker shape:
       - `"circle"`, `"square"`, `"arrowUp"`, `"arrowDown"`.
     - `text`: Additional information about the marker (e.g., `"Buy Order (BTCUSDT) [10]"`).

8. **Tools**:
   - Represent the tools available in the chart's left sidebar.
   - Keys:
     - `id`: Unique identifier for the tool (e.g., `"clickTool"`, `"lineTool"`).
     - `name`: Descriptive name of the tool (e.g., `"Select"`, `"Draw Line"`).
     - `icon`: Reference to the visual icon.
     - `action`: Action performed by the tool:
       - `"click"`: Selection tool.
       - `"drawLine"`: Draw trendlines.
       - `"brush"`: Freehand drawing tool.
       - `"drawText"`: Add text.
       - `"drawRectangle"`: Draw rectangles.
       - `"measure"`: Measure percentage differences between points.
       - `"deleteElements"`: Delete drawn elements.
     - `description`: Description of the tool's functionality.

#### **Validation Rules**
- All objects must include required fields such as `id` and `time`.
- Values must respect formats and restrictions (e.g., `shape` can only be one of the predefined values).
- Dates must follow ISO 8601 format, and Unix times must be calculated correctly.

---

## **2. Output Data**

### **Description**
The component generates interactive charts with visualized data and logs user actions to enhance the analytical experience.

### **Specification**
- **Structure**:
  ```javascript
  {
    displayedMarkers: Array<{
      time: number,
      position: "aboveBar" | "belowBar" | "inBar",
      color: string,
      shape: string,
      text: string
    }>,
    chartData: {
      candles: Array<{ open: number, close: number, high: number, low: number, time: string }>,
      indicators: { EMA: Array<number>, Stochastic: Array<number> }
    },
    userInteractions: {
      type: "marker-added" | "marker-removed" | "filter-applied" | "chart-type-switched",
      details: object
    }
  }
  ```

- **Events or Callbacks**:
  - `onMarkerAdded(marker: object): void`
  - `onFilterApplied(filters: object): void`
  - `onChartTypeSwitched(type: "candlestick" | "line"): void`

---

This updated design incorporates the requested changes in `position`, `shape`, and the left sidebar tools, ensuring greater flexibility and clarity for integration into the `Charts` component.

