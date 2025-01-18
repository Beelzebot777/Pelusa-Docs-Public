# Requirement Specification

## **Initial Questions**

### **General Purpose**

- **What is the main function of this component in the application?**
  
  Provide information about orders executed across different wallets in the BingX exchange.

- **What specific problem does it solve or functionality does it add?**
  - Display orders in a table and filter them by intervals, order types, strategies/wallets, and tickers.
  - Display executed orders on the main chart (Charts Component).
  - Show the profit/loss of an order on the chart using a "Delta tooltip." If the order is closed, the Delta tooltip will display the final values; if open, the last candlestick will represent the closing point. Delta tooltip is a sample plugin from lightweight-charts by TradingView.
  - Display orders distributed by hour on a Radar-Chart.

### **Usage Context**

- **Where will this component be located within the user interface?**
  
  In the central chart area (Charts Component) to display markers, in the right panel for relevant information, and in the bottom section as a table. It will be accessible from the NavBar.

- **What other components will it interact with (if applicable)?**
  
  With the Charts Component and the Strategies Component.

### **Target Users**

- **Who will use this component?**
  - Investors, traders, and administrators.

### **Input and Output**

- **What data does the component need to function (inputs)?**
  
  Data including markers (date and text), order information such as ticker, interval, price, time, type, strategy, and amount.

- **What data or elements does it produce as a result (outputs)?**
  
  Visualization of markers, tables with data, and a Radar-Chart showing the hourly distribution of orders.

### **Acceptance Criteria**

- **What metrics or conditions will determine whether this component is complete or functional?**
  - Markers on the main chart (Charts).
  - A functional Radar-Chart in the orders panel.
  - A complete table with data: ID, Ticker, Interval, Price, Time, Type, Strategy/Wallet.

### **Style and Design**

- **Do you have a specific style in mind for this component?**
  
  It should align with the overall design of the application.

- **Will it be a responsive design?**
  
  No, it will not be responsive.

---

## **Building the Requirement Specification**

### **Description**

The component will allow users to visualize and analyze executed orders in the BingX exchange. It will integrate data into a main chart, filterable tables, and a Radar-Chart for hourly distribution.

### **Objectives**

- Visualize executed orders on the main chart (Charts).
- Filter orders by intervals, types, strategies/wallets, and tickers.
- Display the profit/loss of orders using Delta tooltip.
- Analyze the hourly distribution of orders in a Radar-Chart.
- Integrate the data into a table format for detailed consultation.

### **Usage Context**

- **Where:** Located in the central area (chart), right side (informative panel), and bottom section (table) of the application. Accessible from the NavBar.
- **How:** Interacts with the Charts component to display markers and Delta tooltip, and with Strategies to filter and categorize data.

### **Acceptance Criteria**

- Correct visualization of markers on the main chart.
- A functional Radar-Chart in the side panel.
- A complete table with data: ID, Ticker, Interval, Price, Time, Type, Strategy/Wallet.
- Operational filters by intervals, types, strategies/wallets, and tickers.
- Delta tooltip correctly displaying profit/loss.

