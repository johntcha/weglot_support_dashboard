
# Presentation

This project is a PHP built dashboard retrieving the essential information about the amazing Support Team using Simple HTML DOM Scraper and the Helpscout API. Here is the link for it: [](http://ec2-3-124-218-190.eu-central-1.compute.amazonaws.com/)[http://ec123456789.example.compute.amazonaws.com/](http://ec123456789.example.compute.amazonaws.com/).

The dashboard is split into 3 major parts: the reviews, the statistics of each member of the support team and the statistic of the past and current week.


![alt text](https://github.com/johntcha/weglot_support_dashboard/blob/master/dashboard.png?raw=true)

## The Ubuntu instance

To access it:

(You may need to modify the location of the pem file in the following code, the pem file is not among the files in Github)

sudo ssh -i /Applications/XAMPP/xamppfiles/htdocs/Side_project/side_project_instance.pem [ubuntu@example.compute.amazonaws.com](mailto:ubuntu@example.compute.amazonaws.com)

The project directory _weglot-support-dashboard_ is inside /var/www/

```jsx
cd /var/www/weglot-support-dashboard

```

The permission to write in the .txt files has been added with the following command:

```jsx
sudo chown -R www-data:www-data /var/www/weglot-dashboard-support

```

## Reviews

This is the biggest part of the program as it requires to scrap the 3 review platforms (Shopify, WordPress and Trustpilot) and I had to filter the reviews and add some conditions to them to get only the 5 stars reviews of the week and month.

The reviews are counted by using scrapping with Simple HTML DOM. The program get all the dates and the numbers of stars of the current week and the current month. The dates and the number of stars are all added in an array so the program can filter them. Once this information recuperated, the program is filtering 5 stars reviews from the others.

Trustpilot reviews couldn't be recuperated with scrapping and I couldn't use the Trustpilot API since their support team was not responding (need to have the validation from the TP support to be able to use it). They are recuperated from the total of the Trustpilot reviews: the program is writing the date and the number of the total review on Trustpilot in a .txt file. At each page loading, the program is writing the current total number of reviews on TP and then compares it to the initial number of reviews. 
On Sunday (and Monday if the website is not loaded on Sunday), the program is clearing the .txt file the whole day. It is the same system for the monthly reviews but the .txt file is cleared the last day of the month. The issues here are if the website is not loaded on Sunday/Monday, the past week reviews will remain in the .txt file and this program can't make the difference between the 5 stars reviews and the other ones for Trustpilot.

## Chart

The program is using Helpscout API by fetching the information of the "Report" section. It compares last weeks and this week statistics. The charts are generated with ChartJS and are called in the index.php file.

## Team member statistics

All non-support team members are excluded so they won't appear on the table.

Such as the chart data, the information is recuperated by using the Helpscout API "Report" section.

The Replies sent ratio should be calculated by the last team member's -1 number of sent messages since Karina is also sending the message for the churns.

A possibility to automate this processus can be to create an array of the support team members and always takes the n-1 team member.

### Review cover (Bonus: commented in the code)

The automatic review song is working when the total number of reviews is changing (same system as the TP one) but .txt file clearing process is not working well.

The idea is to clear the .txt file when the total review number of the week has changed. The function in the index.php file is executed if there are no reviews. However, the problem is that the function is executed even if it is in an else condition and this condition is not valid.

## Displaying the dashboard on the screen

Weglot is using Chromecast in order to display the website on the screen.

# Possible issues

1.  If the website is not loaded on Sunday or Monday, the program will keep the last week Monday number of review as the first reference for TP and they will add up on the next week. At the moment, deleting the content and adding manually the number of total reviews on Monday/Thursday in the tp_reviews.txt file can be a solution.
2.  The same thing can happen to the tp_review_month.txt file if the website is not loaded on the first day of each month. Manually deleting the content of the file the next day and adding the current number of reviews can be a solution.
3.  If there is too many people on the Support team (more than 10 people), the statistic bottom part might hidden since the dashboard is not CSS responsive.


