# Data Design for `Diary` Component

---

## **1. Input Data**

### **Description**
The `Diary` component processes and integrates various types of input data to allow users to create, edit, and manage journal entries related to their trading activity. These inputs include direct user inputs, associations with other application entities (e.g., alarms, orders, positions), and file uploads.

### **Specification**
- **Structure**:
  ```javascript
  {
    entries: Array<{
      id: string,                 // Unique identifier
      date: string,               // ISO 8601 format, e.g., "2025-01-20T14:00:00Z"
      title: string,              // Title of the entry
      content: string,            // Main body of the entry
      references: {
        alarms: Array<string>,    // Associated alarm IDs
        orders: Array<string>,    // Associated order IDs
        positions: Array<string>, // Associated position IDs
        strategies: Array<string> // Associated strategy names
      },
      files: Array<File>,         // Attached files or images
      tags: Array<string>         // Tags or labels for categorization
    }>
  }
  ```
- **Types and Formats**:
  - **`entries`**:
    - Type: `Array<Object>`
    - Format:
      - `id`: `string` (UUID or unique string)
      - `date`: `string` (ISO 8601 format)
      - `title`: `string` (max length: 100 characters)
      - `content`: `string` (unlimited length, markdown or plain text)
      - `references`: `Object`
      - `files`: `Array<File>` (files such as `.jpg`, `.png`, `.pdf`)
      - `tags`: `Array<string>` (predefined or user-created tags)
- **Validation Rules**:
  - `title`: Mandatory, max length: 100 characters.
  - `content`: Optional, but a warning is displayed if left blank.
  - `references`: Optional, with valid ID formats for associations.
  - `files`: Optional, max size per file: 5MB, max number of files: 5.
  - `tags`: Optional, max 10 tags per entry.

---

## **2. Output Data**

### **Description**
The `Diary` component emits processed data to enable interaction with other components and update the application state. These outputs include event triggers, state updates, and data synchronization with other entities.

### **Specification**
- **Structure**:
  ```javascript
  {
    updatedEntries: Array<{
      id: string,
      date: string,
      title: string,
      content: string,
      references: {
        alarms: Array<string>,
        orders: Array<string>,
        positions: Array<string>,
        strategies: Array<string>
      },
      files: Array<File>,
      tags: Array<string>
    }>
  }
  ```
- **Types and Formats**:
  - **`updatedEntries`**: Array of updated or newly created entries.
- **Events or Callbacks**:
  - `onEntryCreate(entry: Object): void` - Triggered after a new entry is successfully created.
  - `onEntryUpdate(entry: Object): void` - Triggered when an entry is edited and saved.
  - `onEntryDelete(entryId: string): void` - Triggered when an entry is deleted.
  - `onFileUpload(file: File): void` - Triggered after a file is uploaded.

---

## **3. API Integration**

### **Description**
The `Diary` component interacts with backend APIs to store and retrieve journal entries, handle associations, and manage files.

### **Specification**
- **Endpoints**:
  - **GET `/diary/entries`**:
    - Fetch all or filtered diary entries.
    - Query Parameters:
      - `date`: Filter by specific date.
      - `tags`: Filter by tags.
    - Response Example:
      ```json
      [
        {
          "id": "entry1",
          "date": "2025-01-20T14:00:00Z",
          "title": "Trading Results",
          "content": "Analyzed the outcomes...",
          "references": {
            "alarms": ["alarm1"],
            "orders": ["order1"],
            "positions": [],
            "strategies": ["strategyA"]
          },
          "tags": ["daily-summary"]
        }
      ]
      ```
  - **POST `/diary/entries`**:
    - Create a new diary entry.
    - Request Body Example:
      ```json
      {
        "date": "2025-01-20T14:00:00Z",
        "title": "New Entry",
        "content": "Content of the diary...",
        "references": {
          "alarms": ["alarm1"],
          "orders": []
        },
        "files": []
      }
      ```
  - **PUT `/diary/entries/{id}`**:
    - Update an existing diary entry.
  - **DELETE `/diary/entries/{id}`**:
    - Delete a diary entry.

- **Security**:
  - Use `Authorization: Bearer <token>` headers for authenticated requests.
- **Error Handling**:
  - `400 Bad Request`: Invalid data format.
  - `404 Not Found`: Entry not found.
  - `500 Internal Server Error`: Server-side error.

---

## **4. Data Flow Diagram (Optional)**

### **Description**
A visual representation of data flow through the `Diary` component.

1. **Input**:
   - User fills out the form with title, content, references, and files.
2. **Processing**:
   - Input data is validated, associated with entities, and sent to the API.
3. **Output**:
   - API returns processed data for display and state update.

---

## **5. Data Handling Optimization (Optional)**

### **Strategies**
- **Pagination**:
  - Fetch diary entries in chunks to reduce load times.
- **Lazy Loading**:
  - Load file previews or additional entries as needed.
- **Error Control**:
  - Validate inputs before submission to minimize API errors.
- **Memoization**:
  - Cache frequently accessed data, such as tags and references.

---

This document provides a comprehensive guide to the `Diary` component's data handling requirements and ensures alignment with the application’s broader architecture.

