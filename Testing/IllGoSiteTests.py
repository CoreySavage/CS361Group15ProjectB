#NOTE: Each indent is 1 tab
# for more info on Python testing: https://jeffknupp.com/blog/2013/12/09/improve-your-python-understanding-unit-testing/ 
# for more info on Selenium: http://docs.seleniumhq.org/docs/03_webdriver.jsp#introducing-the-selenium-webdriver-api-by-example 
import unittest
import time

# need selenium python bindings
from selenium import webdriver
from selenium.webdriver.common.keys import Keys

from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import WebDriverWait # available since 2.4.0
from selenium.webdriver.support import expected_conditions as EC # available since 2.26.0

baseURL = "http://web.engr.oregonstate.edu/~bonneym/"
newAccountURL = baseURL + "newaccount.php"
communitiesURL = baseURL + "communities.php"

class NewAccountTestCases(unittest.TestCase):
        """Testing NewAccount.php page"""
        @classmethod
        def setUpClass(self):
                self.firefox = webdriver.Firefox()
                self.firefox.get(newAccountURL)

        @classmethod
        def tearDownClass(self):
                time.sleep(5) #only so we can see what's happening
                self.firefox.quit()


        def test_new_account_page_is_accessible(self):
                """Is the new account page accessible?""" #this question gets printed on the console for easy reading
                # Here is the SET UP code
                WebDriverWait(self.firefox, 10).until(EC.title_contains("Create Account"))
                self.assertIn("Create Account", self.firefox.title)

        def test_first_name_is_editable(self):
                """Can the first name field be edited?"""
                textbox = self.firefox.find_element_by_id("inputFirstname")
                time.sleep(1) #only so we can see what's happening
                textbox.send_keys("Primary Name")
                text = textbox.get_attribute("value")
                self.assertIn("Primary Name", text)

        def test_last_name_is_editable(self):
                """Can the last name field be edited?"""
                textbox = self.firefox.find_element_by_id("inputLastname")
                time.sleep(1) #only so we can see what's happening
                textbox.send_keys("Last Name")
                text = textbox.get_attribute("value")
                self.assertIn("Last Name", text)

        def test_user_name_is_editable(self):
                """Can the user name field be edited?"""
                textbox = self.firefox.find_element_by_id("inputUsername")
                time.sleep(1) #only so we can see what's happening
                textbox.send_keys("testUserName")
                text = textbox.get_attribute("value")
                self.assertIn("testUserName", text)

        def test_password_is_editable(self):
                """Can the password field be edited?"""
                textbox = self.firefox.find_element_by_id("inputPassword")
                time.sleep(1) #only so we can see what's happening
                textbox.send_keys("testPassword")
                text = textbox.get_attribute("value")
                self.assertIn("testPassword", text)

        def test_checkbox_is_editable(self):
                """Can the educator checkbox be edited?"""
                checkbox = self.firefox.find_element_by_id("educator")
                time.sleep(1) #only so we can see what's happening
                self.assertTrue(not checkbox.is_selected())
                checkbox.click()
                self.assertTrue(checkbox.is_selected())
               


    
class CommunitiesTestCases(unittest.TestCase):
        """Testing communities.php page"""
        @classmethod
        def setUpClass(self):
                self.firefox = webdriver.Firefox()
                self.firefox.get(communitiesURL)

        @classmethod
        def tearDownClass(self):
                time.sleep(5) #only so we can see what's happening
                self.firefox.quit()


        def test_communities_page_is_accessible(self):
                """Is the communities page accessible?""" #this question gets printed on the console for easy reading
                # Here is the SET UP code
                WebDriverWait(self.firefox, 10).until(EC.title_contains("Opportunities"))
                self.assertIn("Opportunities", self.firefox.title)

        def test_city_is_editable(self):
                """Can the city field be edited?"""
                textbox = self.firefox.find_element_by_name("Name")  #misnomer for city variable in communities.php 
                time.sleep(1) #only so we can see what's happening
                textbox.send_keys("cityName")
                text = textbox.get_attribute("value")
                self.assertIn("cityName", text)

        def test_state_is_editable(self):
                """Can the State field be edited?"""
                textbox = self.firefox.find_element_by_name("State")
                time.sleep(1)
                textbox.send_keys("stateName")
                text = textbox.get_attribute("value")
                self.assertIn("stateName", text)

        def test_country_is_editable(self):
                """Can the country field be edited?"""
                textbox = self.firefox.find_element_by_name("Country")
                time.sleep(1)
                textbox.send_keys("countryName")
                text = textbox.get_attribute("value")
                self.assertIn("countryName", text)

        def test_skill_needed_is_editable(self):
                """Can the skill needed field be edited?"""
                textbox = self.firefox.find_element_by_name("Skill")
                time.sleep(1)
                textbox.send_keys("specific skill")
                text = textbox.get_attribute("value")
                self.assertIn("specific skill", text)

        def test_comments_is_editable(self):
                """Can the comments field be edited?"""
                textbox = self.firefox.find_element_by_name("Comment")
                time.sleep(1)
                testComment = "This string is being used to test the comment field."
                textbox.send_keys(testComment)
                text = textbox.get_attribute("value")
                self.assertIn(testComment, text)

               
if __name__ == '__main__':
        unittest.main(verbosity=2)
