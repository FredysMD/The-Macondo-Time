import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from webdriver_manager.chrome import ChromeDriverManager

driver = webdriver.Chrome(ChromeDriverManager().install())
driver.get('http://localhost:8000/login')

search_box = driver.find_element_by_name('email')
search_box2 = driver.find_element_by_name('password')


time.sleep(5)

search_box.send_keys('fmarquezduque@gmail.com'+ Keys.RETURN)
search_box2.send_keys('3235957462f'+ Keys.RETURN)

time.sleep(20)

driver.quit()
