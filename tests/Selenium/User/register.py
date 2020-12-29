import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from webdriver_manager.chrome import ChromeDriverManager

driver = webdriver.Chrome(ChromeDriverManager().install())
driver.get('http://localhost:8000/register')

search_box = driver.find_element_by_name('name')
search_box2 = driver.find_element_by_name('email')
search_box3 = driver.find_element_by_name('password')
search_box4 = driver.find_element_by_name('password_confirmation')

time.sleep(5)

search_box.send_keys('User Test'+ Keys.RETURN)
search_box2.send_keys('usertest@gmail.com'+ Keys.RETURN)
search_box3.send_keys('usertest'+ Keys.RETURN)
search_box4.send_keys('usertest'+ Keys.RETURN)

time.sleep(20)

driver.quit()
