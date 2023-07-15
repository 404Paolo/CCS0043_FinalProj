<div class="modal" style="visibility: hidden;">
  <div class="coinshop-container">
    <button class="remove" onclick="toggleVisibility('.modal'); ">X</button>
    <div class="coin-group">
      <?php
      foreach ($coin_inventory as $coin) { ?>
        <div class="coin-card">
          <div class="card-head">
            <div class="price">&#8369
              <?php echo $coin['price']; ?>
            </div>
            <img class="coin-img" src="<?php echo $coin['image']; ?>">
          </div>
          <div class="card-body">
            <div class="item-name" style="color: rgba(15, 79, 90, 0.7);">
              <?php echo $coin['name']; ?>:
              <p style="margin-left:10px;">
                <?php echo $coin['value']; ?>
              </p>
              <img src="assets/PokeCoin.png" class="small-icon" style="margin-left: 5px">
            </div>
            <button class="button">
              Buy
            </button>
          </div>
        </div>
        <?php
      } ?>
    </div>
    <div class="payment-grid">
      <h1 style="text-align: center; border-bottom: 1px solid rgba(0,0,0,0.2);
          padding-bottom: 20px;">Payment</h1>
      <div class="payment-body">
        <h1>
          <?php echo $_SESSION['user']->getName(); ?>
        </h1>
        <h4>User name: <span style="font-weight: 400;">
            <?php echo $_SESSION['user']->getUName(); ?>
          </span></h2>
          <h4>Player id: <span style="font-weight: 400;">
              <?php echo $_SESSION['user']->getIGN(); ?>
            </span></h4>
          <h4>Email: <span style="font-weight: 400;">
              <?php echo $_SESSION['user']->getEmail(); ?>
            </span></h4>
          <div class="payment-computation">
            <h4>Current coin balance: 0</h4>
            <h4>Current coin balance: 0</h4>
            <h4>Current coin balance: 0</h4>
          </div>
          <div class="input-grid" style="align-content: center; justify-content: center;">
            <input class="gcash-number" type="text" placeholder="Gcash number ex. 09#########" style="margin: 0;">
            <div class="payment-buttons">
              <button type="text" class="button gray" style="border: solid 1px; width: 49%;"
                onclick="toggleVisibility('.modal');">
                Cancel
              </button>
              <button type="text" class="button green pay-button" style="width: 49%" ;>
                <img src="assets/GCash-Logo.png" class="small icon" style="margin-right: 5px;">
                &#8369 300
              </button>
            </div>
          </div>
      </div>
      <div class="coin-balance">
        <h1 style="margin: 5px;">
          <?php echo $_SESSION['user']->getBalance(); ?> Pokecoins<h1>
            <img src="assets/PokeCoin.png" class="small-icon">
      </div>
    </div>
  </div>
</div>