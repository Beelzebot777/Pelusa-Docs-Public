# **TradeReports Component Requirements Specification**

---

## **Description**
This component will allow users to upload an Excel file downloaded from BingX containing information about all trades executed on the exchange. It will process this data to generate tables, charts, and useful statistics to help users understand monthly profitability, identify buy and sell points, and produce reports for tax purposes.

---

## **Objectives**
1. Allow users to upload an Excel file via an interactive button.
2. Process the Excel file and load its data into an internal object within the component.
3. Generate a table displaying the main columns from the Excel file.
4. Produce a bar chart representing the monthly Profit and Loss (PNL).
5. Provide a foundation for expanding functionality towards advanced analysis and tax-related reports.

---

## **Usage Context**
- **Where**:  
  The component will be accessible from the application’s **navBar**, identified by an icon resembling a book or similar, representing "reports".
- **How**:  
  Initially, it will function independently, but in the future, it could integrate with a candlestick chart to mark executed trades visually.

---

## **Acceptance Criteria**
1. The component must allow uploading an Excel file via an interactive button.
2. Upon uploading the file, it must process and display the data in a table with the main columns from the Excel file.
3. It must generate a bar chart representing the monthly PNL.
4. The design must follow the application's minimalistic style with purple tones.
5. A responsive design is not required at this initial stage.

---
