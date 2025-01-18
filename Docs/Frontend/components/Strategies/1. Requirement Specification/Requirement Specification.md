# Requirements Specification: **Strategies** Component

## **Initial Questions**

### **General Purpose**

- **What is the main function of this component in the application?**
  - Activate and deactivate strategies, which are determined by alarms.

- **What specific problem does it solve or functionality does it add?**
  - Assign wallets to operate strategies.
  - Draw a vertical line on the chart (Charts Component) when the strategy is activated.
  - Draw a vertical line on the chart (Charts Component) when the strategy is deactivated.
  - Display operations performed by the strategy on the chart (Charts Component).

### **Usage Context**

- **Where will this component be located in the user interface?**
  - In the main section of the navigation panel, accessible from the main navigation menu.

- **What other components will it interact with (if applicable)?**
  - **Alarms**: To associate strategies with alarms (Alarms Component).
  - **Charts**: To display performance and operations (Charts Component).
  - **Tables**: To display relevant information such as the number of operations, PnL, number of shorts, number of longs, and accuracy percentage since operations started.
  - **Control Panel**: List of strategies to activate, pause, stop, and configure.

### **Target Users**

- **Who will use this component?**
  - Investors, traders, and administrators.

### **Input and Output**

- **What data does the component need to function (inputs)?**
  - List of strategies with their respective names.
  - Configurable parameters per strategy (active/inactive/paused) and detailed configurations.
  - Statistical data for the various strategies.

- **What data or elements does it produce as a result (outputs)?**
  - List of strategies with configurations.
  - Performance visualization (charts and statistics).

### **Acceptance Criteria**

- Allow activating, pausing, and stopping strategies.
- Represent the start, end, and operations of strategies on the chart (Charts Component).
- Display relevant information for each strategy in a table.
- Seamless integration with related components (Alarms and Charts).

### **Style and Design**

- **Do you have a specific style in mind for this component?**
  - Follow the same design as other components.

- **Will it be a responsive design?**
  - No, this component will not be responsive.

---

## **Building the Requirement Specification**

### **Description**

The **Strategies** component will allow users to manage customized strategies for trading operations. This component will serve as a central panel for defining and analyzing specific configurations related to investment strategies. Additionally, it will visualize strategy operations and performance in charts and tables.

### **Objectives**

- Create customized strategies with configurable parameters.
- Display statistical and graphical information on strategy performance.
- Provide tools to edit and delete existing strategies.
- Visualize the start, end, and operations of strategies in charts.

### **Usage Context**

- **Where:**
  - Located in the main dashboard, accessible from the sidebar navigation.

- **How:**
  - Interact with alarm components to associate strategies.
  - Display visual data in charts and tables to facilitate analysis.

### **Acceptance Criteria**

1. Allow activating, pausing, and stopping strategies.
2. Display clear and interactive visual representations in the charts.
3. Provide seamless integration with the backend and other related components.
4. Display relevant information in tables, such as PnL and the number of operations performed.

### **Style and Design**

- Follow the general style guide of the application (primary colors, typography, etc.).
- This component will not be responsive and will be optimized for large screens.

---

