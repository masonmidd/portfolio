import random as r

# declaring starting variables and lists
# https://bicyclecards.com/how-to-play/blackjack/

cards = []
card_numbers = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"]
print("Welcome to blackjack. Your balance is 100. \n")
balance = 100
current_bet = 0

# players

dealer = []
player = []

# shuffle function

def shuffle():
  dealer.clear()
  player.clear()
  card_numbers = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"]
  cards.clear()
  while len(cards) < 52:
    current_number = card_numbers.pop()
    cards.append(current_number + "S")
    cards.append(current_number + "H")
    cards.append(current_number + "D")
    cards.append(current_number + "C")
    r.shuffle(cards)

# bet function

def bet():
  global balance
  global current_bet
  current_bet = int(input("Place your bet: "))
  if balance >= current_bet:
    balance -= current_bet
  else:
    print("Insufficient balance. Please place a different bet. \n")
    bet()

# card conversion

def cardtonumber(card):
  try:
    return int(card)
  except:
    if card == "T":
      return 10
    if card == "J":
      return 10
    if card == "K":
      return 10
    if card == "Q":
      return 10
    if card == "A":
      return "ace"


#Anila
def cardtotal(playerlist):
  count = 0
  has_ace = False
  run = 0
  items = len(playerlist)
  while run < items:
    addto = cardtonumber(playerlist[run][0])
    run += 1
    try:
      count += addto
    except:
      if addto == "ace":
        has_ace = True
  if has_ace == True:
    return count + 1, count + 11
  else:
    return count

#Colin and Anila
def deal():
  player.append(cards.pop())
  dealer.append(cards.pop())
  player.append(cards.pop())
  dealer.append(cards.pop())
  print("Your cards: ", player[0], ",", player[1])
  print("Dealer's cards: ", dealer[0], ", ?")
  print("You: ", str(cardtotal(player)))
  checkblackjack(player)

#Mason, Colin, Alejandro
def doubledown():
  if cardtotal(player) == 21:
    print("You've won black jack!")
  else:
    double = input("Would you like to double down? (Y/N): ")
    if double == "y" or "Y":
      global balance
      global current_bet
      balance = balance - current_bet
      current_bet = current_bet * 2
      print("Your current bet is: " + str(current_bet))
      print("Balance: ", str(balance))
      hit()
# not doubling down
#draw statement
    elif cardtotal(player) == cardtotal(dealer):
      print("Both players ended with the same total, so it is a draw!")
  #you lost statement
    elif cardtotal(player) > 21 or cardtotal(player) < cardtotal(dealer):
      print("You Lost")
  #you won statement
    elif cardtotal(player) < 21 and cardtotal(player) > cardtotal(dealer):
      print("")

#Colin
def hit():
  answer = input("Would you like another card? (Y/N): ")
  if answer == "y" or "Y":
    player.append(cards.pop())
    print("You:", str(cardtotal(player)))
    checkblackjack(player)
    hit()
  if answer == "n" or "N":
    dealerflip()

#Colin
def checkblackjack(playerlist):
  global balance
  global current_bet
  if type(cardtotal(player)) is tuple:
    if cardtotal(player)[0] > 21 and cardtotal(player)[1] > 21:
      bust()
    elif cardtotal(player)[0] == 21:
      if type(cardtotal(dealer)) == tuple:
        if (cardtotal(dealer)[0] == 21) or (cardtotal(dealer)[1] == 21) :
          print("Tie!")
          balance += current_bet
          retry()
      print("blackjack")
      balance += (current_bet * 2)
      print("Balance: ", str(balance))
      dealerflip()
    elif cardtotal(player)[1] == 21:
      print("blackjack")
      balance += (current_bet * 2)
      print("Balance: ", str(balance))
      dealerflip()
  else:
    if cardtotal(player) == 21:
      print("blackjack")
      balance += (current_bet * 2)
      print("Balance: ", str(balance))
      dealerflip()
    if cardtotal(player) > 21:
      bust()

#Alejandro
def retry():
  retry = input("Would you like to play again? (Y/N):").lower()
  if retry == "y":
    game()
  else:
    print("Thank You for Playing! You ended with a balance of ", str(balance))

#Colin
def bust():
  print("You lost!")
  retry()

#dealer reveals cards 
#Mason, Colin, Alejandro
def dealerflip():
  print("Dealer Flip")
  if type(cardtotal(dealer)) == tuple:
    if (cardtotal(dealer)[0] >= 17) or (cardtotal(dealer)[1] >= 17) :
      print("Dealer: ", str(cardtotal(dealer)))
  else:
    if cardtotal(dealer) >= 17:
        print("Dealer: ", str(cardtotal(dealer)))
    elif cardtotal(dealer) <= 16:
        while cardtotal(dealer) >= 17:
            dealer.append(cards.pop())
            print("Dealer: ", str(cardtotal(dealer)))
    
    
  

'''
When the dealer has served every player, the dealers face-down card is turned up. If the total is 17 or more, it must stand. If the total is 16 or under, they must take a card. The dealer must continue to take cards until the total is 17 or more, at which point the dealer must stand. If the dealer has an ace, and counting it as 11 would bring the total to 17 or more (but not over 21), the dealer must count the ace as 11 and stand. The dealer's decisions, then, are automatic on all plays, whereas the player always has the option of taking one or more cards.
'''
#Colin
def game():
  print("Current balance: ", str(balance))
  bet()
  shuffle()
  deal()
  doubledown()


game()

#Play again option
#Done I think
