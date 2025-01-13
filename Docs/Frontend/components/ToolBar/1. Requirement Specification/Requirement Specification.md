# Requirement Specification

## **Initial Questions**

### **General Purpose**
- **What is the primary function of this component in the application?**  
  The primary function of the `ToolBar` component is to provide a set of tools enabling users to interact with the candlestick chart (`Charts`). Its features include:  
  - Selecting a **Ticker** to update the chart.
  - Changing the **time interval** through a button panel.
  - Adding **indicators** (e.g., EMAs and Stochastic) via a dropdown menu.
  - Jumping to a specific point in time using an **input** inside a dropdown.
  - Displaying a clock that shows the current time and the opening, closing, premarket, or postmarket hours of major markets.  
  The component should be designed to occupy minimal space.

- **What specific problem does it solve or what functionality does it add?**  
  This component enhances usability by allowing users to:  
  - Dynamically adjust the chart's time interval.  
  - Update the chart with a selected Ticker.  
  - Overlay indicators on the chart for advanced technical analysis.  
  - Navigate directly to specific timestamps.  
  The `ToolBar` centralizes these interactions, simplifying user operations and improving the overall experience.

### **Usage Context**
- **Where will this component be located within the user interface?**  
  The component will be located at the top of the user interface as a fixed, visible toolbar.

- **What other components will it interact with (if applicable)?**  
  This component will primarily interact with the `Charts` component, sending data and commands to update the graphical content.

### **Target Users**
- **Who will use this component?**  
  Users interested in viewing financial market data, such as traders, investors, and analysts.

### **Input and Output**
- **What data does the component need to function (inputs)?**  
  - The date and time manually selected via an **input** in the jump-to-time button.

- **What data or elements does it produce as a result (outputs)?**  
  - Actions or data sent to the `Charts` component, such as the selected Ticker, time interval, indicators, and jump-to-time details.

### **Acceptance Criteria**
- **What metrics or conditions will determine whether this component is complete or functional?**  
  The component will be considered complete when it satisfies the following conditions:  
  - Allows users to change the Ticker and update the chart in real-time.  
  - Provides options to select and switch time intervals.  
  - Facilitates adding and removing chart indicators.  
  - Enables users to jump to a specific point in time.  
  - Accurately displays the current time and the key trading hours of major markets.

### **Style and Design**
- **Do you have a specific style in mind for this component?**  
  The component will follow the visual style already established in the application for consistency.

- **Will it be a responsive design?**  
  No, the design will not be responsive.

---

## **Building the Requirement Specification**

### **Description**
The `ToolBar` component allows users to interact with the main candlestick chart (`Charts`) by offering options to select a Ticker, change time intervals, add indicators, navigate specific timestamps, and display key market times. This component centralizes and simplifies user interaction within the application.

### **Objectives**
- Enable users to select a **Ticker** to update the chart.
- Provide a button panel to change the chart's **time interval**.
- Offer a dropdown menu for adding/removing **indicators** like EMAs and Stochastic.
- Facilitate **jumping in time** to a specific date and time via an input in a dropdown.
- Display a clock showing the **current time** and key times (opening, closing, premarket, and postmarket) of major markets.
