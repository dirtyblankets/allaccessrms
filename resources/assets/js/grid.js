$("#jqxgrid").jqxGrid({
    source: source,
    theme: 'classic',
    // datafields should match exactly the column names in your database.  
    columns: [
    { text: 'Company Name', datafield: 'CompanyName', width: 250 },
    { text: 'ContactName', datafield: 'ContactName', width: 150 },
    { text: 'Contact Title', datafield: 'ContactTitle', width: 180 },
    { text: 'Address', datafield: 'Address', width: 200 },
    { text: 'City', datafield: 'City', width: 120 }]
});