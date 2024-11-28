# Requirement Specification: `Alarms` Component

## **Description**
The `Alarms` component is exclusively designed to read and display alarm data stored in the database. Its purpose is to provide a visual and interactive representation of alarms on the main chart (candlestick chart), in tables with various filtering options, and through analytical charts to facilitate understanding of alarm behavior. Additionally, it includes sections for general statistics and detailed management of alarms through multiple views.

---

## **Objectives**
1. **Visualization on the Main Chart**:
   - Display alarms directly on the candlestick chart using representative visual markers.

2. **Visualization in Tables**:
   - Present alarms in a table format with the following columns:
     - **ID**
     - **Ticker**
     - **Interval**
     - **Price**
     - **Time**
     - **Type**
     - **Strategy**
   - Allow sorting and filtering based on these attributes.

3. **Visual Analysis with Charts**:
   - Provide interactive and dynamic charts to analyze the total number of alarms based on:
     - Intervals (`1m`, `5m`, `15m`, `30m`, `1h`, `4h`, `D`, `W`, `M`).
     - Strategies.
     - Tickers.
     - **Type Order**: (Open Long, Close Long, Open Short, Close Short).
     - Monthly distribution.

4. **General Statistics**:
   - Display useful numerical information, such as:
     - **Last captured alarm**: Time and date in the format `SS:MM:HH-DD/MM/YYYY` and the associated strategy (`STRATEGY_NAME`).
     - **Total alarms captured today**.
     - Other relevant data derived directly from the database.

5. **Data Synchronization**:
   - Ensure that data displayed on the main chart, tables, graphs, and statistics are synchronized and updated every second.

6. **Tabs in `AlarmPanel`**:
   - Include two tabs in the `AlarmPanel`:
     - **Tab 1**: Displays the `AlarmGraph` subcomponent.
     - **Tab 2**: Displays the `AlarmStats` subcomponent.
   - Position the `AlarmPanel` to the right of the main chart, occupying 30% of the total width.

7. **Tabs in `TablePanel`**:
   - Include three tabs in the `TablePanel`:
     - **Alarms**: Displays all alarms without filtering.
     - **Selected Alarms**:
       - Shows alarms selected via:
         - Clicking on markers on the candlestick chart.
         - Selecting rows directly in the tables of other tabs.
     - **Filtered Alarms**:
       - Displays alarms filtered based on the applied filters.
   - Allow seamless transitions between tabs.

8. **Table Filters**:
   - Implement dropdown menus in `AlarmTableFilters` for:
     - **Intervals**: (`1m`, `5m`, `15m`, `30m`, `1h`, `4h`, `D`, `W`, `M`).
     - **Order Type**: (Open Long, Close Long, Open Short, Close Short).
     - **Strategies**: Dynamic list from the database.
     - **Tickers**: Dynamic list from the database.
   - Allow:
     - Multiple selection.
     - Selecting none or all options.
   - Display selected options as chips or tags for clarity.

---

## **Usage Context**
- **Where**:
   - The component will be part of the main dashboard, serving as a key tool for analyzing and managing alarms.

- **How**:
   - Interacts with:
     - **Main Chart**: Displaying alarms directly on the candlestick chart.
     - **Redux Store**: To maintain centralized data and applied filters.
     - **Backend API**: To query and load alarms from the database.
     - **Graphical Components**: For analytical visualizations.

---

## **Acceptance Criteria**
1. **Visualization on the Main Chart**:
   - Display alarms on the candlestick chart using clear and identifiable markers.
   - Include tooltips with specific details for each alarm.

2. **Interactive Tables**:
   - Display alarms in a table allowing:
     - Sorting by columns: `ID`, `Ticker`, `Interval`, `Price`, `Time`, `Type`, `Strategy`.
     - Filtering by:
       - Interval.
       - Strategy.
       - Type.
       - Ticker.
       - **Type Order**: (Open Long, Close Long, Open Short, Close Short).
     - Pagination for large data volumes.

3. **Analytical Charts**:
   - Provide clear and useful visualizations, such as:
     - Number of alarms by interval (bar or line charts).
     - Distribution by strategy, ticker, and **Type Order**.
     - Monthly distribution.

4. **General Statistics**:
   - Display relevant data such as:
     - Time, date, and strategy of the **last captured alarm**.
     - **Total alarms captured today**.
     - Other useful insights derived from the fetched data.

5. **Tabs in `AlarmPanel`**:
   - Show `AlarmGraph` or `AlarmStats` content based on the selected tab.
   - Ensure seamless transitions between tabs.

6. **Tabs in `TablePanel`**:
   - **Alarms**:
     - Display all alarms from the database.
   - **Selected Alarms**:
     - Show alarms selected via clicks on the chart or rows in other tables.
   - **Filtered Alarms**:
     - Display alarms that match applied filters.

7. **Performance and Integration**:
   - Update component data every 1 second, ensuring real-time synchronization with the database.
   - Ensure updates do not degrade the overall application performance.

8. **Visual Feedback and Errors**:
   - Display clear messages if no data is available or if an error occurs while fetching alarms.
   - Use visual indicators, such as spinners, for loading states.

---

## **Planned Separation of Subcomponents**
To improve modularity and maintainability, the `Alarms` component will be divided into the following subcomponents:
- **`AlarmTable`**: Handles the tabular representation of alarms with filtering and sorting functionality.
- **`AlarmGraph`**: Manages graphical visualizations of alarm analytics.
- **`AlarmStats`**: Displays general statistics and numerical insights about the alarms.
- **`AlarmOverlay`**: Displays alarms as visual markers directly on the main candlestick chart.
- **`AlarmPanel`**: Combines `AlarmGraph` and `AlarmStats` into a tabbed interface, positioned to the right of the main chart and occupying 30% of the width.
- **`TablePanel`**: Combines multiple table views (`Alarms`, `Selected Alarms`, `Filtered Alarms`) into a tabbed interface.

---

Let me know if further refinements are needed or if you'd like to proceed to the **UI/UX Design** phase. 😊
