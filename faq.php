<?php
  include 'controller.php'; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Goal Tracker</title>
        <!-- fontawesome! -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- bootstrap CSS !-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- style.css -->     
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
    <div class="container-fluid both-col-12">
      <div class="col-6">
                    <div class="left-title">
                        <h2><a href="index.php">KARMA</a></h2>
                    </div>
                </div>
    <div class="row welcome-name">
    <div class="welcome-text">
        <h1>FAQs</h1>
    </div>
    </div>
      
    <div class="faq">
      <ul id="faq-list">
        
      </ul>
    </div>

    </div>
    
      
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        
        <!-- bootstrap Javascript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <!-- Javascript file -->
        <script src="js/script.js"></script>
        <script>
          const $htmlToElement = (html) => {
            const template = document.createElement('template');
            html = html.trim();
            template.innerHTML = html;

            return template.content.firstChild;
          };

          const faqs = [
            {
              title: `How does Goal Tracker work`,
              body: 'Goal Tracker is built on a foundation of core features, such as data standards, content management and data visualisation tools that can be adapted to any feature be it Finacial Tracker, Task Master, Project Management etc. It is set up in such a way that you cand and delete task from a goal, you can also mark it to be complete',
            },
            {
              title: 'Creating an Account', 
              body: 'You can create an account by clicking the Sign up button, Input your name, email and password and voila, you can start creating your goals and achieving them '
            },
            {
              title: 'Forgot Password?',
              body: 'Click on the Forgot Password link in the Karmanor login screen. Enter your registered email address, enter the captcha code and hit Request. You will receive an email to the registered email address with the password reset link. Click the link and reset the password.'
            },
            {
              title: 'How can I add a Goal?',
              body: 'You can add a note by tapping the ‘Create Goal’ button. After tapping the ‘Create Goal’ button, input the name of Goal you want to create. Write down the due date and then save it by simply tapping the ‘Save’ button.'
            }, 
            {
              title: 'How can I add a Task',
              body: 'You can add a note by tapping the ‘Add Task’ button. After tapping the ‘Add Task’ button, input the name of Task you want to create. Write down the due date and then save it by simply tapping the ‘Save’ button.'
            }, 
            {
              title: 'Marking a task',
              body: 'karma goal tracker provided a way to visualize your complete tasks, you are to click on mark complete, it will put a line through the task'
            },
            {
              title: 'How do I Delete a Goal',
              body: 'You can add a note by tapping the ‘Delete’ button. After tapping the ‘Delete Task’ button, a prompt message would ask if you want to delete, click ok and it will be deleted'
            },
             {
              title: 'How do I Delete a Task',
              body: 'You can add a note by tapping the ‘Delete’ button. After tapping the ‘Delete Task’ button, a prompt message would ask if you want to delete, click ok and it will be deleted'
            }
          ];

          const faqItemTemplate = `<li class="faq-item">
                                    <div class="faq-item__btn">
                                      <button>+</button>
                                      <span class="faq-item__title">title</span>
                                    </div>
                                    <p class="faq-item__body hide">body</p>
                                  </li>`;
          
          const faqList = document.querySelector('#faq-list');

          faqs.forEach(({ title, body }) => {
            const faqItem = $htmlToElement(faqItemTemplate);
            
            faqItem.querySelector('.faq-item__title').innerText = title;
            faqItem.querySelector('.faq-item__body').innerText = body;
            faqItem.querySelector('.faq-item__btn').addEventListener('click', () => {
              faqItem.querySelector('.faq-item__body').classList.toggle('hide');
            });

            faqList.appendChild(faqItem);
          });
        </script>
    </body>
    
</html>