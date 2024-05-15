#etch a sketch game
#importing turtle #lucy

from turtle import Turtle, Screen
t = Turtle()
window = Screen()
window.bgcolor('white')
window.tracer(0)
window.setup(width=500, height=500)

t.begin_fill()

#introducing the game
print('Welcome to our etch a sketch game. Follow the directions to create a sketch.')

#giving the user the option to pick a color
def color():
  linecolor = input('What color would you like? (Choose: red, yellow, green): ')
  linecolor = linecolor.lower()
  if linecolor == 'red':
    t.color('red')
  elif linecolor == 'yellow':
    t.color('yellow')
  elif linecolor == 'green':
    t.color('green')
  else: 
    print("Invalid input. Type one of the given colors.")
    color()
color()

user_input = 0

#allowing user to choose directions
def getinput():
  user_input = input('Do you want to move forwards, backwards, up or down? (to fill shape, type quit): ')
  user_input = user_input.lower()
  return user_input
getinput()

#setting the distance for forwards and backwards
def x(user_input):
  for i in range(50): 
    if user_input == 'forwards':
      t.forward(1)
      t.distance(2, 2)
      
    elif user_input == 'backwards':
      t.backward(1)
      t.distance(2, 2)

    else: 
      print("Invalid input. Type one of the two options.")

#setting the distance for up and down
def y(user_input):
  for i in range(50): 
    if user_input == 'up':
      t.sety(100)
      #t.left(90)
      '''
      t.forward(20)
      t.distance(2, 2)
      t.penup()
      t.pendown()
      break
      '''
    elif user_input == 'down':
      t.sety(-100)
      #t.right(90)
      '''
      t.forward(20)
      t.distance(2, 2)
      t.penup()
      t.pendown()
      break
      '''
    else: 
      print("Invalid input. Type one of the two options.")
  

user_input = getinput()

#While loop to run and get the correct input from the user
while user_input != 'quit':
  if user_input == 'forwards' or user_input == 'backwards':
    x(user_input)
    user_input = getinput()
  elif user_input == 'up' or user_input == 'down':
    y(user_input)
    user_input = getinput()
  elif user_input == 'reset':
    window.resetscreen()
    window.tracer(0)
    getinput()
  elif user_input == 'quit':
    break
  else: 
      print("Invalid input. Type one of the two options.")
      getinput()

#fill shape with a color
def shapecolor():
  user_input2= input("What color do you want to fill the shape with? green, red, purple, or pink?")
  user_input2 = user_input2.lower()
  if user_input2 == "green":
    t.fillcolor("green")
    t.end_fill()
  elif user_input2 == "red":
    t.fillcolor("red")
    t.end_fill()
  elif user_input2 == "purple":
    t.fillcolor("purple")
    t.end_fill()
  elif user_input2 == "pink":
    t.fillcolor("pink")
    t.end_fill()
  else: 
    print("Invalid input. Type one of the given colors.")
shapecolor()