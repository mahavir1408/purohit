README
Credential:
user: pes, password: pes@123

1. Make "Servcie Tax=14", "Edu Chess=0", "Higher Edu Chess=0"
Link http://localhost/PurohitNew/EditMonthlyBill.php?bid=460
http://localhost/PurohitNew/EditMonthlyBill.php?bid=1755

http://localhost/PurohitNew/EditMonthlyBill.php?bid=1287
1. Increase the service tax to 14
2. Add Cleanliness tax to 0.5
3. Show sum of Amount column in Total field

2. Docket Id, "skipped 6000 id's"
http://localhost/PurohitNew/EditMonthlyBill.php?bid=460

3. Allow user to set LR\POD as checked if it is received else uncheck
http://localhost/PurohitNew/SearchDocket.php# (search by Docket Number:615)
http://localhost/PurohitNew/EditMonthlyTranscation.php?did=18713

4. Populate "Bank Name", "Cheque no." and "Amount Paid", it becomes empty when opened in edit mode
http://localhost/PurohitNew/SearchBill.php# (search by Bill Number:138)
http://localhost/PurohitNew/EditMonthlyBill.php?bid=1234

5. Display "Bank Name" and "Cheque Number" field if "Payment Mode" is "Cheque" else just display "Bank Name" if "Payment Mode" is related to Bank.
http://localhost/PurohitNew/Accounts_NewTranscation.php

6. Add a Print functionality
http://localhost/PurohitNew/Report_ServiceTax.php

7. Order by "Name of Party"
http://localhost/PurohitNew/Accounts_ListTranscation.php

8. Add a "Amount Paid" Column
http://localhost/PurohitNew/SearchBill.php#

9. Generate Print for Ledger for specific party (order by bill number)
http://localhost/PurohitNew/SearchBill.php# (search by Party Name)

10. Link "Name of Party" to the result of (http://localhost/PurohitNew/SearchBill.php#) for that party
http://localhost/PurohitNew/Accounts_ListTranscation.php

11. Set Master password for B.R. Purohit system. Do not allow any user to login (Password change feature)
http://localhost/brp/welcome.php

12. Remove header "PUROHIT EXPRESS SERVICES" from print functionality
http://localhost/PurohitNew/ViewMonthlyBill.php?bid=1280#

13. Allow user to select header "PUROHIT EXPRESS SERVICES" on print functionality (Add checkbox "Do you want Printhead?")
http://localhost/PurohitNew/ViewMonthlyBill.php?bid=1280#

14. Add character limit (50 character) for "Particular"
http://localhost/PurohitNew/MonthlyTranscation.php

15. Date column showing undefined
http://localhost/PurohitNew/SearchBill.php

16. Create a page where user should be able to add payment against bill number or client name or date like below. UI should be like
http://localhost/PurohitNew/Accounts_NewTranscation.php

17. Create a page that maintain all cash doc and allow user to generate bill in one go

Note:
1. Bill is sum of collection of dockets between range of date