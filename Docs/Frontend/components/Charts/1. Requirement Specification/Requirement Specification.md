# Requirements Specification

## **Initial Questions**

### **General Purpose**

- **What is the primary function of this component in the application?**

  The **Charts** component aims to display interactive graphs showcasing key trading information, such as alarms, orders, diary entries, positions, and executed strategies. This includes clear and functional visualization of data to facilitate analysis and decision-making.

- **What specific problem does it solve or what functionality does it add?**

  This component helps users understand and visualize both completed and planned trading activities. Additionally, it offers interactive tools for:

  - Drawing trend lines on the chart.
  - Drawing with a brush on the chart.
  - Drawing rectangles on the chart.
  - Adding text to the chart.
  - Calculating percentage and value differences between two points on the chart.
  - Deleting elements from the chart.
  - Hiding or showing chart elements.
  - Using technical indicators like EMAs and Stochastic.
  - Loading candlestick charts for different **tickers**.
  - Loading historical data for various time intervals.
  - Jumping in time to view past data.
  - Refreshing chart data every second via webhooks.
  - Switching between candlestick and line charts.

### **Usage Context**

- **Where will this component be located within the user interface?**

  This component will be located in the central part of the application, directly below the **ToolBar** and to the left of the **NavBar**.

- **What other components will it interact with (if applicable)?**

  This component will interact with:

  - **ToolBar**
  - **Alarms**
  - **Orders**
  - **Positions**
  - **Strategies**
  - **Backtesting**
  - **Diary**
  - **News**
  - **Earnings**
  - **CurrencyConverter**
  - **Battlefield**

### **Target Users**

- **Who will use this component?**

  End users interested in managing and analyzing their trading activity.

### **Input and Output**

- **What data does the component need to function (inputs)?**

  - Data for **tickers** (candlestick charts).
  - Marker data (text and date).
  - Previously saved elements, such as trend lines and annotations.

- **What data or elements does it produce as a result (outputs)?**

  - Candlestick and line charts.
  - Markers indicating alarms, orders, operations, news, and key points.
  - Interactive elements like rectangles, lines, and text.

### **Acceptance Criteria**

- For the component to be considered complete, it must meet the following conditions:

  - Display markers for strategies, orders, positions, alarms, diary entries, and backtesting.
  - Allow editing and deletion of graphical elements.
  - Provide real-time updates via webhooks.
  - Offer interactive tools for drawing and technical analysis.

### **Style and Design**

- **Do you have a specific style in mind for this component?**

  The design should align with the style already implemented in the other components of the application.

- **Will it be a responsive design?**

  It will not be responsive.

---

## **Building the Requirement Specification**

### **Description**

The **Charts** component is a central tool for visualizing and analyzing trading data. Its primary purpose is to provide interactive charts and analytical tools to help users better interpret their trading activity and make informed decisions.

### **Objectives**

- Display interactive charts with markers for alarms, orders, positions, and strategies.
- Provide drawing tools for lines, rectangles, and text.
- Incorporate technical indicators like EMAs and Stochastic.
- Allow real-time updates via webhooks.
- Facilitate historical navigation and interval switching.
- Integrate with other key components of the application for a cohesive user experience.

### **Usage Context**

- **Where:**
  In the central part of the interface, prominently positioned below the **ToolBar** and to the left of the **NavBar**.

- **How:**
  The component connects to the backend to load real-time data, updates the global state via **Redux**, and interacts with other modules such as **Alarms**, **Orders**, and **Strategies**.

### **Acceptance Criteria**

- Display relevant data in interactive charts with clear and organized representation.
- Offer tools for customization and technical analysis.
- Update in real-time without affecting application performance.
- Seamlessly integrate with other components and the global state.
- Handle data errors or connection issues with clear messages and retry options.

