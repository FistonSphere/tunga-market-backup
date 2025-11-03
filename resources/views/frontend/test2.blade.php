@extends('layouts.app')
@section('content')
<style>
    /* 
## Colors

### Primary

- Orange: hsl(26, 100%, 55%)
- Pale orange: hsl(25, 100%, 94%)

### Neutral

- Very dark blue: hsl(220, 13%, 13%)
- Dark grayish blue: hsl(219, 9%, 45%)
- Grayish blue: hsl(220, 14%, 75%)
- Light grayish blue: hsl(223, 64%, 98%)
- White: hsl(0, 0%, 100%)
- Black (with 75% opacity for lightbox background): hsl(0, 0%, 0%)

## Typography

### Body Copy

- Font size (paragraph): 16px

### Font

- Family: [Kumbh Sans](https://fonts.google.com/specimen/Kumbh+Sans)
- Weights: 400, 700

*/

/*^ start of general styles */
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
:root {
  --orange: hsl(26, 100%, 55%);
  --paleOrange: hsl(25, 100%, 94%);
  --veryDarkBlue: hsl(220, 13%, 13%);
  --darkGrayishBlue: hsl(219, 9%, 45%);
  --grayishBlue: hsl(220, 14%, 75%);
  --lightGrayishBlue: hsl(223, 64%, 98%);
  font-family: "Kumbh Sans", sans-serif;
  color: var(--veryDarkBlue);
}

a {
  text-decoration: none;
  font-size: 1rem;
  color: var(--veryDarkBlue);
  text-transform: capitalize;
}

button {
  background-color: transparent;
  border: none;
}
/*^ end of general styles */

/*^ start of common styles */
.header,
.account,
.navMenu,
.mainSec,
.priceInfo,
.salePrice,
.productNumber,
.imgControls,
.next,
.previous,
.cartInfo {
  display: flex;
  align-items: center;
}
.header,
.account,
.priceInfo,
.salePrice {
  column-gap: 1rem;
}

.cursorPointer {
  cursor: pointer;
}

.addToCart,
.badge {
  background-color: var(--orange);
  color: white;
}

.badge,
.navLink a,
.alert {
  font-weight: 500;
}
    /*^ start of main sec */
main {
  min-height: 80vh;
  padding-bottom: 70px;
}

.mainSec {
  flex-direction: column;
  row-gap: 1.5rem;
}

.productImgs,
.productImgs img {
  width: 100%;
}

.productTitle,
.productDesc,
.priceInfo {
  margin-bottom: 1.2rem;
}

.productHeadline,
.sale,
.plus,
.minus {
  color: var(--orange);
}

.productTitle,
.currentPrice {
  font-size: calc(1.5rem + 0.3vw);
}

.currentPrice,
.originalPrice,
.sale,
.plus,
.minus,
.num,
.addToCart {
  font-weight: 700;
}

.productNumber,
.sale,
.addToCart {
  border-radius: 10px;
}

.productImgs {
  position: relative;
}

.imgControls,
.controls {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  justify-content: space-between;
  padding: 0 10px;
}

.next,
.previous {
  width: 30px;
  height: 30px;
  padding: 5px;
  background-color: white;
  border-radius: 50%;
  justify-content: center;
}

.imgControls img,
.controls img {
  width: 40%;
}

.productHeadline {
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2.1;
  margin-bottom: 0.7rem;
}

.productTitle {
  color: var(--veryDarkBlue);
}

.productDesc {
  color: var(--darkGrayishBlue);
  line-height: 1.5;
}

.sale {
  background-color: var(--paleOrange);
  padding: 0.5rem;
}

.originalPrice {
  color: var(--grayishBlue);
  text-decoration: line-through;
}

.priceInfo {
  justify-content: space-between;
}

.cartInfo {
  flex-direction: column;
  row-gap: 1.2rem;
}

.productNumber {
  background-color: var(--lightGrayishBlue);
  padding: 0 1rem;
  justify-content: space-between;
}

.plus,
.minus {
  font-size: calc(1.7rem + 0.5vw);
  padding: 3px 0 10px 0;
}
.num {
  font-size: 1.1rem;
  padding: 5px 0;
}

.addToCart,
.productNumber {
  width: 100%;
}
.addToCart {
  padding: 0.75rem 0.5rem;
  font-size: 1rem;
  box-shadow: 0 30px 20px 0px var(--paleOrange);
}

.addToCart svg {
  margin-right: 0.7rem;
}

.otherImgs {
  display: none;
}

.alert {
  color: red;
  margin-top: 30px;
  font-size: 1.1rem;
}

.lightBox {
  display: none;
}

.alertBox {
  text-align: center;
}

/*^ end of main sec */

/*^ start of media query */
/* *mob menu */
@media screen and (min-width: 768px) {
  header {
    padding: 1.1rem 0;
  }
  .container {
    max-width: 85%;
  }
  .mobMenuIcon {
    display: none;
  }

  .navMenu {
    background-color: transparent;
    position: static;
    width: 100%;
    flex-direction: row;
    column-gap: 0.5rem;
    justify-content: space-between;
  }

  .logo {
    order: -1;
  }

  .header {
    column-gap: 1.5rem;
  }

  .navLink a {
    padding: 0.5rem;
    font-size: 1rem;
  }
}
@media screen and (min-width: 992px) {
  header {
    padding: 0.4rem 0;
  }
  .container {
    max-width: 80%;
  }

  .navMenu {
    column-gap: 1rem;
  }

  .header {
    column-gap: 3rem;
  }

  .navLink a {
    font-size: 1.1rem;
  }
  .profilePic {
    width: 25%;
  }

  .cart {
    width: 15%;
  }

  .account {
    column-gap: 2.5rem;
  }

  .mainSec {
    flex-direction: row;
    column-gap: 5rem;
    justify-content: space-between;
  }

  .currentImg img,
  .otherImgs img,
  .otherImgs .layer {
    border-radius: 10px;
  }

  main {
    border-top: 1px solid var(--grayishBlue);
    max-width: 80%;
    margin: 10px auto;
    padding: 90px 0;
  }

  .secContainer {
    max-width: 88%;
    margin: 0 auto;
  }

  .mobContainer {
    width: 100%;
  }

  main .productImgs {
    width: calc((100% / 3) * 1.3 - 0.5rem);
  }
  .productInfo {
    width: calc((100% / 3) * 1.7 - 0.5rem);
  }

  .cartInfo {
    flex-direction: row;
    justify-content: center;
  }

  .productNumber {
    width: calc(40% - 0.5rem);
  }
  .addToCart {
    width: calc(60% - 0.5rem);
  }

  .imgControls {
    display: none;
  }

  .cartInfo,
  .otherImgs {
    column-gap: 1rem;
  }

  .productTitle {
    font-size: calc(2rem + 0.5vw);
    margin: 1rem 0 1.5rem 0;
  }

  .productDesc {
    margin-bottom: 1.5rem;
  }

  .otherImgs {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
  }

  .otherImgs .img {
    position: relative;
    width: calc(100% / 4);
  }
  .otherImgs img {
    width: 100%;
    max-height: 80px;
  }

  .otherImgs .layer {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    border: 2px solid var(--orange);
  }

  .priceInfo {
    flex-direction: column;
    align-items: start;
    row-gap: 0.5rem;
    margin-bottom: 1.5rem;
  }
  .currentImg img {
    max-height: 400px;
  }

  /* ?start of lightBox */
  .lightBox {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1000;
  }

  .closeIcon svg {
    width: 15px;
  }

  .closeIcon {
    text-align: end;
    padding: 10px 5px;
    margin-bottom: 5px;
  }

  .lightBox .modal {
    width: 30%;
  }

  .lightBox .productImgs .currentImg {
    position: relative;
  }

  .lightBox,
  .controls {
    align-items: center;
  }
  .lightBox {
    justify-content: center;
  }
  .controls {
    display: flex;
    justify-content: space-between;
    padding: 0;
  }

  .controls .previous {
    transform: translateX(-50%);
  }

  .controls .next {
    transform: translateX(50%);
  }

  /* ?end of lightBox */
}
</style>
    <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-body-sm">

                {{-- Home Link --}}
                <a href="{{ route('home') }}" class="text-secondary-600 hover:text-primary transition-fast">Home</a>

                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>

                {{-- Category Link --}}
                @if ($product->category)
                    <a href="{{ route('category.view', $product->category->slug) }}"
                        class="text-secondary-600 hover:text-primary transition-fast">
                        {{ $product->category->name }}
                    </a>

                    <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                @endif

                {{-- Product Name --}}
                <span class="text-primary font-medium">{{ $product->name }}</span>
            </nav>
        </div>
    </section>



    <!-- Product Detail Section -->
    <section class="py-8 bg-white">
      <!-- start of main section -->
    <main>
      <div class="secContainer">
        <section class="mainSec">
          <div class="productImgs">
            <div class="currentImg cursorPointer">
              <img src="https://www.samsungmobilepress.com/file/25F5F842B82F9EBAA623D87523AC82933430B39D53EFFA67E42353F624609CFCDBFD943ED7E1971BAEC8AB8C9590C4CA7238B00366CD61C8B5D6B566926FC357345DAD1093027F101FD0388469A677B75130234CE404C8D767B959E8C3B2FEE98D86AFAF4F3C848743AB1730524E9E5C7CC26EAC0E4DFF6EAB8800660715A64755909ED7F51D018D420342E9597280E5" alt="brown sneakers" />
            </div>
            <div class="otherImgs">
              <div class="img cursorPointer">
                <img
                  src="https://www.samsungmobilepress.com/file/25F5F842B82F9EBAA623D87523AC82933430B39D53EFFA67E42353F624609CFCDBFD943ED7E1971BAEC8AB8C9590C4CA7238B00366CD61C8B5D6B566926FC357345DAD1093027F101FD0388469A677B75130234CE404C8D767B959E8C3B2FEE98D86AFAF4F3C848743AB1730524E9E5C7CC26EAC0E4DFF6EAB8800660715A64755909ED7F51D018D420342E9597280E5"
                  alt="brown sneakers thumbnail first image"
                  class="pImg"
                />
                <div class="layer"></div>
              </div>
              <div class="img cursorPointer">
                <img
                  src="https://www.samsungmobilepress.com/file/515828F7CDAC4DF062DBCB152FA6FB017602E0CC9078379C0E27644770D54F4F297E7E805E99F940AE1D73916BD3E426AA063CAB0D863151598728FEB42E60119952CE58DA24B8014D6CC947FCB97BE8CEF0449DC70517B868A96B3736A55737BD548ECEE8441F44715859C31565F4F03418701F96EE9031A0F66642A33FEC640AE44153234E71C7E8952D5D07020ED3"
                  alt="brown sneakers thumbnail second image"
                  class="pImg"
                />
                <div class="layer"></div>
              </div>
              <div class="img cursorPointer">
                <img
                  src="https://www.samsungmobilepress.com/file/A7FB9487B074076C06263FA484D21B74535765D48EE1BBFF7896D96C203A619CE56B677DA4F33C42F917EAA281EFDE400E05CDF1B6F853F604C39A009761EBE5969D8C07978635DB0D809AC0C9610E39665C7E2A232F030B098523238D58C19E6FFE28D8CDB7D629A3FAC508E537815E81C1B19D94FC9D7D4748BB4693B855306CD0FA33B91AE9A89C0C99405C47C369"
                  alt="brown sneakers thumbnail third image"
                  class="pImg"
                />
                <div class="layer"></div>
              </div>
              <div class="img cursorPointer">
                <img
                  src="https://www.samsungmobilepress.com/file/9A8B0C5E7AE223941FE931B23B810EB4B0889FB378F9B1FA94096036C43DE1D9CBD04954550FBC1C771FCC793F100E9B5F5CA2F530F87B9FD4380D9EADEC2F54798273B45EB93A9033A5AD11EE2772F26A4BAD909A7CC2D855BCEDD00CD694A0D3D74A1A1DFD89AB23A207E29BB7C4FCB75408D09299E0D7A20B2E7C743E5C83BFD92E8F115E7A657CE4E9C368FF4F451E8D9FE7A63E4C776A67EDBF7A360A39"
                  alt="brown sneakers thumbnail forth image"
                  class="pImg"
                />
                <div class="layer"></div>
              </div>
            </div>
            <div class="imgControls">
              <div class="previous cursorPointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
</svg>
              </div>
              <div class="next cursorPointer">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
</svg>
              </div>
            </div>
          </div>
          <div class="productInfo">
            <div class="mobContainer">
              <p class="productHeadline">Sneaker Company</p>
              <h1 class="productTitle">Fall Limited Edition Sneakers</h1>
              <p class="productDesc">
                These low-profile sneakers are your perfect casual wear
                companion. Featuring a durable rubber outer sole, theyâll
                withstand everything the weather can offer.
              </p>
              <div class="priceInfo">
                <div class="salePrice">
                  <span class="currentPrice">$125.00</span>
                  <span class="sale">50%</span>
                </div>
                <div class="original">
                  <span class="originalPrice">$250.00</span>
                </div>
              </div>
              <div class="cartInfo">
                <div class="productNumber">
                  <span class="minus cursorPointer">-</span>
                  <span class="num">0</span>
                  <span class="plus cursorPointer">+</span>
                </div>
                <button class="addToCart cursorPointer">
                  <svg width="22" height="20">
                    <path
                      d="M20.925 3.641H3.863L3.61.816A.896.896 0 0 0 2.717 0H.897a.896.896 0 1 0 0 1.792h1l1.031 11.483c.073.828.52 1.726 1.291 2.336C2.83 17.385 4.099 20 6.359 20c1.875 0 3.197-1.87 2.554-3.642h4.905c-.642 1.77.677 3.642 2.555 3.642a2.72 2.72 0 0 0 2.717-2.717 2.72 2.72 0 0 0-2.717-2.717H6.365c-.681 0-1.274-.41-1.53-1.009l14.321-.842a.896.896 0 0 0 .817-.677l1.821-7.283a.897.897 0 0 0-.87-1.114ZM6.358 18.208a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm10.015 0a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm2.021-7.243-13.8.81-.57-6.341h15.753l-1.383 5.53Z"
                      fill="#fff"
                      fill-rule="nonzero"
                    />
                  </svg>
                  Add to cart
                </button>
              </div>
            </div>
          </div>
        </section>
        <div class="alertBox">
          <p class="alert"></p>
        </div>
      </div>
    </main>
    <!-- end of main section -->

    <!-- start of lightBox -->
    <section class="lightBox">
      <div class="modal">
        <div class="closeIcon cursorPointer">
          <svg width="14" height="15" xmlns="http://www.w3.org/2000/svg">
            <path
              d="m11.596.782 2.122 2.122L9.12 7.499l4.597 4.597-2.122 2.122L7 9.62l-4.595 4.597-2.122-2.122L4.878 7.5.282 2.904 2.404.782l4.595 4.596L11.596.782Z"
              fill="#fff"
              fill-rule="evenodd"
            />
          </svg>
        </div>
        <div class="productImgs">
          <div class="currentImg">
            <img src="https://www.samsungmobilepress.com/file/25F5F842B82F9EBAA623D87523AC82933430B39D53EFFA67E42353F624609CFCDBFD943ED7E1971BAEC8AB8C9590C4CA7238B00366CD61C8B5D6B566926FC357345DAD1093027F101FD0388469A677B75130234CE404C8D767B959E8C3B2FEE98D86AFAF4F3C848743AB1730524E9E5C7CC26EAC0E4DFF6EAB8800660715A64755909ED7F51D018D420342E9597280E5" alt="brown sneakers" />
            <div class="controls">
              <div class="previous cursorPointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
</svg>
              </div>
              <div class="next cursorPointer">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
</svg>
              </div>
            </div>
          </div>
          <div class="otherImgs">
            <div class="img cursorPointer">
              <img
                src="https://www.samsungmobilepress.com/file/25F5F842B82F9EBAA623D87523AC82933430B39D53EFFA67E42353F624609CFCDBFD943ED7E1971BAEC8AB8C9590C4CA7238B00366CD61C8B5D6B566926FC357345DAD1093027F101FD0388469A677B75130234CE404C8D767B959E8C3B2FEE98D86AFAF4F3C848743AB1730524E9E5C7CC26EAC0E4DFF6EAB8800660715A64755909ED7F51D018D420342E9597280E5"
                alt="brown sneakers thumbnail first image"
                class="boxImg"
              />
              <div class="layer"></div>
            </div>
            <div class="img cursorPointer">
              <img
                src="https://www.samsungmobilepress.com/file/515828F7CDAC4DF062DBCB152FA6FB017602E0CC9078379C0E27644770D54F4F297E7E805E99F940AE1D73916BD3E426AA063CAB0D863151598728FEB42E60119952CE58DA24B8014D6CC947FCB97BE8CEF0449DC70517B868A96B3736A55737BD548ECEE8441F44715859C31565F4F03418701F96EE9031A0F66642A33FEC640AE44153234E71C7E8952D5D07020ED3"
                alt="brown sneakers thumbnail second image"
                class="boxImg"
              />
              <div class="layer"></div>
            </div>
            <div class="img cursorPointer">
              <img
                src="https://www.samsungmobilepress.com/file/A7FB9487B074076C06263FA484D21B74535765D48EE1BBFF7896D96C203A619CE56B677DA4F33C42F917EAA281EFDE400E05CDF1B6F853F604C39A009761EBE5969D8C07978635DB0D809AC0C9610E39665C7E2A232F030B098523238D58C19E6FFE28D8CDB7D629A3FAC508E537815E81C1B19D94FC9D7D4748BB4693B855306CD0FA33B91AE9A89C0C99405C47C369"
                alt="brown sneakers thumbnail third image"
                class="boxImg"
              />
              <div class="layer"></div>
            </div>
            <div class="img cursorPointer">
              <img
                src="https://www.samsungmobilepress.com/file/9A8B0C5E7AE223941FE931B23B810EB4B0889FB378F9B1FA94096036C43DE1D9CBD04954550FBC1C771FCC793F100E9B5F5CA2F530F87B9FD4380D9EADEC2F54798273B45EB93A9033A5AD11EE2772F26A4BAD909A7CC2D855BCEDD00CD694A0D3D74A1A1DFD89AB23A207E29BB7C4FCB75408D09299E0D7A20B2E7C743E5C83BFD92E8F115E7A657CE4E9C368FF4F451E8D9FE7A63E4C776A67EDBF7A360A39"
                alt="brown sneakers thumbnail forth image"
                class="boxImg"
              />
              <div class="layer"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end of lightBox -->
    </section>


    <!-- Product Details Tabs -->

    <section class="py-8 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Tab Navigation -->
            <div class="border-b border-border mb-8">
                <nav class="flex space-x-8">
                    <button class="tab-btn active py-4 px-1 border-b-2 border-accent font-semibold text-accent"
                        onclick="showTab('specifications')">Specifications</button>

                    <button
                        class="tab-btn py-4 px-1 border-b-2 border-transparent font-semibold text-secondary-600 hover:text-primary hover:border-secondary-300 transition-fast"
                        onclick="showTab('reviews')">
                        Reviews ({{ $reviewsCount ?? 0 }})
                    </button>
                    <button
                        class="tab-btn py-4 px-1 border-b-2 border-transparent font-semibold text-secondary-600 hover:text-primary hover:border-secondary-300 transition-fast"
                        onclick="showTab('comment')">Add Comment</button>

                </nav>
            </div>

            <!-- Specifications Tab -->
            <div id="specifications" class="tab-content">
                <div class="grid md:grid-cols-2 gap-8">
                    @php
                        $specifications = json_decode($product->specifications, true) ?? [];
                    @endphp

                    @forelse ($specifications as $section => $details)
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-4">{{ ucfirst($section) }}</h3>
                            <div class="space-y-3">
                                @foreach ($specifications as $label => $value)
                                    <div
                                        class="flex items-center justify-between py-2 border-b border-border last:border-none">
                                        <span class="text-secondary-600">{{ $label }}</span>
                                        <span class="font-medium text-primary">{{ $value }}</span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @empty
                        <p class="text-secondary-600">No specifications available for this product.</p>
                    @endforelse
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews" class="tab-content hidden">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Review Summary -->
                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Review Summary</h3>
                        <div class="text-center mb-6">
                            <div class="text-4xl font-bold text-primary mb-2">
                                {{ number_format($product->average_rating, 1) }}</div>
                            <div class="flex justify-center text-warning mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ ($product->average_rating ?? 0) >= $i ? 'fill-current' : 'text-secondary-300' }}"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <div class="text-body-sm text-secondary-600">Based on {{ $product->reviews_count_custom }}
                                reviews</div>
                        </div>

                        <!-- Rating Breakdown (static for now, can be dynamic later) -->
                        <div class="space-y-2">
                            @php
                                $breakdown = $product->rating_breakdown ?? [
                                    5 => 78,
                                    4 => 15,
                                    3 => 4,
                                    2 => 2,
                                    1 => 1,
                                ];
                            @endphp

                            @foreach ($breakdown as $stars => $percent)
                                <div class="flex items-center space-x-3">
                                    <span class="text-body-sm w-8">{{ $stars }} ★</span>
                                    <div class="flex-1 bg-secondary-200 rounded-full h-2">
                                        <div class="bg-warning h-2 rounded-full" style="width: {{ $percent }}%">
                                        </div>
                                    </div>
                                    <span class="text-body-sm text-secondary-600 w-12">{{ $percent }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Review Filters & List -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center space-x-4 mb-6">
                            <span class="font-semibold text-primary">Filter by:</span>
                            <select name="filter" class="input-field py-2 px-3 text-body-sm">
                                <option>All Reviews</option>
                                <option>5 Stars</option>
                                <option>4 Stars</option>
                                <option>3 Stars</option>
                                <option>With Photos</option>
                                <option>Verified Purchase</option>
                            </select>
                            <select name="sort" class="input-field py-2 px-3 text-body-sm">
                                <option>Most Recent</option>
                                <option>Most Helpful</option>
                                <option>Highest Rating</option>
                                <option>Lowest Rating</option>
                            </select>
                        </div>

                        <!-- Individual Reviews -->
                        <div id="reviews-container" class="space-y-6 relative">
                            <div id="reviews-spinner"
                                class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-50 hidden">
                                <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                            </div>

                            <div id="reviews-list">
                                @include('partials.product-reviews', [
                                    'reviews' => $product->reviews,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Comment Tab -->
            <div id="comment" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="active py-4 px-1 border-b-2 font-semibold text-2xl text-gray-900 border-accent font-semibold">Leave a Review</h3>
                        <span class="text-sm text-gray-500">Your feedback helps others!</span>
                    </div>

                    <form id="reviewForm" action="{{ route('reviews.store') }}" method="POST"
                        class="flex flex-col lg:flex-row gap-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Rating Stars -->
                        <div class="lg:w-1/3 flex flex-col items-center lg:items-start">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Your Rating</label>
                            <div class="flex space-x-2 text-3xl" id="starRating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg data-value="{{ $i }}" xmlns="http://www.w3.org/2000/svg"
                                        class="star h-10 w-10 text-gray-300 hover:text-yellow-400 transition duration-200 cursor-pointer"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.178
                                                3.63a1 1 0 00.95.69h3.813c.969 0
                                                1.371 1.24.588 1.81l-3.087
                                                2.243a1 1 0 00-.364 1.118l1.178
                                                3.63c.3.921-.755 1.688-1.54
                                                1.118l-3.087-2.243a1 1 0
                                                00-1.176 0l-3.087
                                                2.243c-.784.57-1.838-.197-1.539-1.118l1.178-3.63a1 1 0
                                                00-.364-1.118L2.42
                                                9.057c-.783-.57-.38-1.81.588-1.81h3.813a1 1 0
                                                00.951-.69l1.178-3.63z" />
                                    </svg>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="ratingValue">
                        </div>

                        <!-- Comment Box -->
                        <div class="flex-1 flex flex-col space-y-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Your Comment</label>
                            <textarea name="comment" id="comment" rows="4" placeholder="Share your experience with this product..."
                                class="w-full border border-gray-200 rounded-xl p-4 text-gray-700 resize-none
                           focus:ring-2 focus:ring-primary focus:border-primary transition shadow-sm"></textarea>

                            <!-- Verified Purchase Badge -->
                            <div class="flex items-center space-x-2">
                                @if ($userHasPurchased ?? false)
                                    <span
                                        class="flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Verified Purchase
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="md:w-1/4 flex md:justify-end">
                            <button type="submit"
                                class="bg-primary hover:bg-primary/90 text-white font-medium py-2 px-5
               rounded-lg shadow-sm hover:shadow-md transition transform hover:scale-105 text-sm md:text-base">
                                Submit Review
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- Inquiry Form Section -->
    <section class="py-8 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card">
                <h2 class="text-2xl font-bold text-primary mb-6">Send Inquiry</h2>

                <form id="enquiryForm" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Your Name *</label>
                            <input type="text" name="name" class="input-field" value="{{ old('name') }}"
                                placeholder="Enter your full name" required>
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Company (Optional)</label>
                            <input type="text" name="company" class="input-field" value="{{ old('company') }}"
                                placeholder="Your company name">
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Email *</label>
                            <input type="email" name="email" class="input-field" value="{{ old('email') }}"
                                placeholder="your.email@company.com" required>
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Phone</label>
                            <input type="tel" name="phone" class="input-field" value="{{ old('phone') }}"
                                placeholder="+1 (555) 123-4567">
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Quantity Needed *</label>
                            <select name="quantity" class="input-field" required>
                                <option value="">Select quantity range</option>
                                <option value="1-99" {{ old('quantity') == '1-99' ? 'selected' : '' }}>1-99 pieces
                                </option>
                                <option value="100-499" {{ old('quantity') == '100-499' ? 'selected' : '' }}>100-499
                                    pieces
                                </option>
                                <option value="500-999" {{ old('quantity') == '500-999' ? 'selected' : '' }}>500-999
                                    pieces
                                </option>
                                <option value="1000+" {{ old('quantity') == '1000+' ? 'selected' : '' }}>1000+ pieces
                                </option>
                            </select>
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Target Price</label>
                            <input type="text" name="target_price" class="input-field"
                                value="{{ old('target_price') }}" placeholder="$0.00 per unit">
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-body-sm font-semibold text-primary mb-2">Message *</label>
                        <textarea name="message" class="input-field resize-none" rows="4"
                            placeholder="Please include any specific requirements, colors, customization needs, or other details..." required>{{ old('message') }}</textarea>
                        <span class="text-red-500 text-sm mt-1 error-message"></span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <input type="checkbox" id="terms" name="terms"
                            class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded" required>
                        <label for="terms" class="text-body-sm text-secondary-700">
                            I agree to the <a href="#" class="text-accent hover:underline">Terms of
                                Service</a> and
                            <a href="#" class="text-accent hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="btn-primary flex-1">Send Inquiry</button>
                        <button type="reset" class="btn-secondary">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Related Products Section -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($relatedProducts->isNotEmpty())
                <h2 class="text-2xl font-bold text-primary mb-8">{{ $relatedTitle }}</h2>

                <!-- Swiper Container -->
                <div class="swiper related-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($relatedProducts as $related)
                            @php
                                $gallery = json_decode($related->gallery, true);
                                $image = $gallery[0] ?? $related->main_image;
                            @endphp

                            <div class="swiper-slide">
                                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                                    <div>
                                        <div class="relative overflow-hidden rounded-lg mb-4">
                                            <a href="{{ route('product.view', $related->sku) }}">
                                                <img src="{{ $image }}" alt="{{ $product->name }}"
                                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                                    loading="lazy"
                                                    onerror="this.src='{{ $product->main_image }}'; this.onerror=null;" />
                                            </a>
                                            <button onclick="addToWishlist({{ $product->id }})"
                                                class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <a href="{{ route('product.view', $related->sku) }}">
                                        <h3 class="font-semibold text-primary mb-2">{{ $related->name }}</h3>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-baseline space-x-2">
                                                <span class="text-xl font-bold text-primary">
                                                    {{ number_format($related->price, 2) }} {{ $related->currency }}
                                                </span>
                                                @if ($related->old_price)
                                                    <span class="text-body-sm text-secondary-500 line-through">
                                                        {{ number_format($related->old_price, 2) }}
                                                        {{ $related->currency }}
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="text-success text-body-sm">Free Shipping</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="swiper-button-prev !text-primary"></div>
                    <div class="swiper-button-next !text-primary"></div>

                    <!-- Pagination Dots -->
                    <div class="swiper-pagination mt-6"></div>
                </div>
            @endif
        </div>
    </section>



    <div id="toast2"
        class="hidden fixed bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50"
        style="right:10px;top: 8px;--tw-bg-opacity: 1;background-color: rgb(22 163 74 / var(--tw-bg-opacity, 1)); color: #fff; z-index: 999999;">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Enquiry Sent Successfully</span>
    </div>
    <div id="toast-comment"
        class="hidden fixed bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50"
        style="right:10px;top: 8px;--tw-bg-opacity: 1;background-color: rgb(22 163 74 / var(--tw-bg-opacity, 1)); color: #fff; z-index: 999999;">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Feedback Added Successfully</span>
    </div>
    <div id="review-modal-wrapper"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="review-modal" class="bg-white rounded-2xl shadow-lg w-full max-w-md mx-auto p-8 relative">

            <!-- Close Button -->
            <button onclick="closeReviewModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100">
                ✖
            </button>

            <!-- Icon -->
            <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                ⭐
            </div>

            @guest
                <h2 class="text-xl font-bold text-center mb-3">Sign in to leave a review</h2>
                <p class="text-gray-600 text-center mb-6">Please log in before reviewing this product.</p>
                <a href="{{ route('login') }}" class="btn-primary w-full py-3 rounded-lg font-semibold block text-center">
                    Sign In
                </a>
            @else
                <h2 class="text-xl font-bold text-center mb-3">Leave a Review</h2>
                <form id="review-form" method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Rating</label>
                        <select name="rating" class="w-full border rounded-lg p-2">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <p class="text-red-500 text-sm mt-1 error-message" data-error-for="rating"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Comment</label>
                        <textarea name="comment" class="w-full border rounded-lg p-2"></textarea>
                        <p class="text-red-500 text-sm mt-1 error-message" data-error-for="comment"></p>
                    </div>

                    <button type="submit"
                        class="btn-primary w-full py-3 rounded-lg font-semibold transition-all hover:scale-105">
                        Submit Review
                    </button>
                </form>
            @endguest
        </div>
    </div>

    <div id="arModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-4">
            <!-- Close Button -->
            <button id="closeArModal"
                class="absolute top-3 right-3 bg-gray-100 hover:bg-red-500 hover:text-white rounded-full p-2 transition z-50">
                ✕
            </button>

            <!-- Fake 3D Viewer -->
            <div id="fake3dViewer"
                class="relative w-full h-96 flex items-center justify-center bg-gray-100 rounded-lg overflow-hidden cursor-grab">

                <img id="fake3dImage" src="" class="max-h-full max-w-full object-fill select-none"
                    draggable="false" />

                <!-- Prev Button -->
                <button id="prevImageBtn"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-accent hover:text-white rounded-full p-3 shadow-md transition z-10">
                    ‹
                </button>

                <!-- Next Button -->
                <button id="nextImageBtn"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-accent hover:text-white rounded-full p-3 shadow-md transition z-10">
                    ›
                </button>
            </div>

            <p class="text-center text-gray-500 mt-2 text-sm">Drag left/right or use arrows to rotate product</p>
        </div>
    </div>

    <!-- Login Warning Modal (hidden by default) -->
    <div id="login-warning-modal-wrapper"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="login-warning-modal"
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">
            <!-- Close Button -->
            <button onclick="continueBrowsing()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>

            <!-- Main Message -->
            <h2 class="text-2xl font-bold text-primary mb-3">Sign in to save your favorites</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Join us to unlock your personalized shopping experience and never lose track of the products you love.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="goToSignIn()"
                    class="w-full btn-primary py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Sign In to My Account
                </button>
                <button onclick="continueBrowsing()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Continue Browsing Without Account
                </button>
            </div>
        </div>
    </div>
    <div id="login-warning-modal-wrapper2"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="login-warning-modal"
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">
            <!-- Close Button -->
            <button onclick="continueBrowsing()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>

            <!-- Main Message -->
            <h2 class="text-xl font-bold text-primary mb-3" style="text-align: center">Sign in to add to cart</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Join us to unlock your personalized shopping experience and never lose track of the products you love.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="goToSignIn()"
                    class="w-full btn-primary py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Sign In to My Account
                </button>
                <button onclick="continueBrowsing()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Continue Browsing Without Account
                </button>
            </div>
        </div>
    </div>


    <!-- Toast Wrapper -->
    <div id="toast" class="hidden" style="z-index:99999">
        <div
            class="toast-message flex items-center p-4 max-w-xs w-full text-white rounded-lg shadow-lg transition transform duration-300 ease-in-out opacity-0 scale-95">
            <span id="toast-text" class="flex-1 text-sm font-medium"></span>
            <button onclick="document.getElementById('toast').classList.add('hidden')"
                class="ml-3 text-white hover:text-gray-200 focus:outline-none">
                ✕
            </button>
        </div>
    </div>



    <script>
        // document.addEventListener("DOMContentLoaded", () => {
        //     const arBtn = document.getElementById("arPreviewBtn");
        //     const modal = document.getElementById("arModal");
        //     const imgViewer = document.getElementById("fake3dImage");
        //     const viewer = document.getElementById("fake3dViewer");
        //     const closeBtn = document.getElementById("closeArModal");
        //     const prevBtn = document.getElementById("prevImageBtn");
        //     const nextBtn = document.getElementById("nextImageBtn");

        //     let galleryImages = [];
        //     let currentIndex = 0;

        //     arBtn.addEventListener("click", () => {
        //         const mainImage = arBtn.dataset.main || "";
        //         let rawGallery = arBtn.dataset.gallery || "[]";

        //         // Decode double-encoded JSON
        //         if (rawGallery.startsWith('"') && rawGallery.endsWith('"')) {
        //             rawGallery = rawGallery.slice(1, -1);
        //         }
        //         rawGallery = rawGallery.replace(/\\"/g, '"').replace(/\\\//g, '/');
        //         rawGallery = rawGallery.replace(/\\u([\dA-F]{4})/gi, (match, grp) => {
        //             return String.fromCharCode(parseInt(grp, 16));
        //         });

        //         try {
        //             const gallery = JSON.parse(rawGallery);
        //             if (Array.isArray(gallery)) galleryImages = [...gallery];
        //             else galleryImages = [];
        //         } catch (e) {
        //             galleryImages = [];
        //         }

        //         // Insert main image at start
        //         if (mainImage) galleryImages.unshift(mainImage);


        //         if (galleryImages.length === 0) return;

        //         currentIndex = 0;
        //         imgViewer.src = galleryImages[currentIndex];
        //         modal.classList.remove("hidden");
        //         modal.classList.add("flex");
        //     });

        //     // Close modal
        //     closeBtn.addEventListener("click", () => {
        //         modal.classList.add("hidden");
        //         modal.classList.remove("flex");
        //     });

        //     // Switch image function for prev/next buttons
        //     const switchImage = (direction = 1) => {
        //         if (galleryImages.length === 0) return;

        //         currentIndex = (currentIndex + direction + galleryImages.length) % galleryImages.length;

        //         // Set rotation direction
        //         const rotationAngle = direction > 0 ? 360 : -360;

        //         // Animate rotation
        //         imgViewer.style.transition = "transform 0.6s ease-in-out";
        //         imgViewer.style.transform = `rotateY(${rotationAngle}deg)`;

        //         // After animation, reset transform and change image
        //         setTimeout(() => {
        //             imgViewer.style.transition = "none"; // remove transition for next rotation
        //             imgViewer.style.transform = "rotateY(0deg)";
        //             imgViewer.src = galleryImages[currentIndex];
        //         }, 600);
        //     };


        //     prevBtn.addEventListener("click", () => switchImage(-1));
        //     nextBtn.addEventListener("click", () => switchImage(1));

        //     // Dragging for 360° feel
        //     let isDragging = false;
        //     let startX = 0;

        //     viewer.addEventListener("mousedown", e => {
        //         isDragging = true;
        //         startX = e.clientX;
        //         viewer.style.cursor = "grabbing";
        //     });
        //     viewer.addEventListener("mouseup", () => {
        //         isDragging = false;
        //         viewer.style.cursor = "grab";
        //     });
        //     viewer.addEventListener("mouseleave", () => {
        //         isDragging = false;
        //         viewer.style.cursor = "grab";
        //     });
        //     viewer.addEventListener("mousemove", e => {
        //         if (!isDragging) return;
        //         const diff = e.clientX - startX;
        //         if (Math.abs(diff) > 5) { // smaller threshold for continuous feel
        //             switchImage(diff > 0 ? -1 : 1);
        //             startX = e.clientX;
        //         }
        //     });

        //     // Touch support
        //     viewer.addEventListener("touchstart", e => startX = e.touches[0].clientX);
        //     viewer.addEventListener("touchmove", e => {
        //         const diff = e.touches[0].clientX - startX;
        //         if (Math.abs(diff) > 5) {
        //             switchImage(diff > 0 ? -1 : 1);
        //             startX = e.touches[0].clientX;
        //         }
        //     });
        // });

        //zoom
        document.addEventListener("DOMContentLoaded", () => {
            const wrapper = document.getElementById("imageWrapper");
            const mainImage = document.getElementById("mainImage");
            const lens = document.getElementById("zoomLens");

            let ZOOM = 2.5; // magnification
            const LENS_R = lens.offsetWidth / 2;
            let imgReady = false;

            function getCoverFit() {
                const cw = wrapper.clientWidth;
                const ch = wrapper.clientHeight;
                const iw = mainImage.naturalWidth;
                const ih = mainImage.naturalHeight;

                const scale = Math.max(cw / iw, ch / ih);
                const displayW = iw * scale;
                const displayH = ih * scale;
                const offsetX = (cw - displayW) / 2;
                const offsetY = (ch - displayH) / 2;

                return {
                    cw,
                    ch,
                    iw,
                    ih,
                    scale,
                    displayW,
                    displayH,
                    offsetX,
                    offsetY
                };
            }

            function showLens() {
                if (!imgReady) return;
                lens.style.backgroundImage = `url('${mainImage.src}')`;
                lens.style.backgroundSize =
                    `${mainImage.naturalWidth * ZOOM}px ${mainImage.naturalHeight * ZOOM}px`;
                lens.classList.remove("hidden");
            }

            function hideLens() {
                lens.classList.add("hidden");
            }

            function moveLensFromEvent(e) {
                if (!imgReady) return;
                const fit = getCoverFit();
                const rect = wrapper.getBoundingClientRect();

                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                let x = clientX - rect.left;
                let y = clientY - rect.top;

                x = Math.max(LENS_R, Math.min(fit.cw - LENS_R, x));
                y = Math.max(LENS_R, Math.min(fit.ch - LENS_R, y));

                lens.style.left = `${x - LENS_R}px`;
                lens.style.top = `${y - LENS_R}px`;

                // Convert display coords to natural image coords
                const imgX = (x - fit.offsetX) / fit.scale;
                const imgY = (y - fit.offsetY) / fit.scale;

                // Position background so hovered pixel is centered
                const bgPosX = -(imgX * ZOOM - LENS_R);
                const bgPosY = -(imgY * ZOOM - LENS_R);

                lens.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
                lens.style.backgroundSize =
                    `${mainImage.naturalWidth * ZOOM}px ${mainImage.naturalHeight * ZOOM}px`;
            }

            wrapper.addEventListener("mouseenter", showLens);
            wrapper.addEventListener("mouseleave", hideLens);
            wrapper.addEventListener("mousemove", moveLensFromEvent);

            wrapper.addEventListener("touchstart", (e) => {
                showLens();
                moveLensFromEvent(e);
            }, {
                passive: true
            });
            wrapper.addEventListener("touchmove", (e) => moveLensFromEvent(e), {
                passive: true
            });
            wrapper.addEventListener("touchend", hideLens);

            function markReady() {
                imgReady = true;
                lens.style.backgroundImage = `url('${mainImage.src}')`;
                lens.style.backgroundSize =
                    `${mainImage.naturalWidth * ZOOM}px ${mainImage.naturalHeight * ZOOM}px`;
            }

            if (mainImage.complete && mainImage.naturalWidth) {
                markReady();
            } else {
                mainImage.addEventListener("load", markReady, {
                    once: true
                });
            }

            window.changeMainImage = (el, src) => {
                document.querySelectorAll(".thumbnail-btn").forEach(btn => btn.classList.remove("active",
                    "border-accent"));
                if (el) el.classList.add("active", "border-accent");
                imgReady = false;
                mainImage.src = src;
                mainImage.addEventListener("load", markReady, {
                    once: true
                });
            };
        });

        document.addEventListener("DOMContentLoaded", () => {
            const fullscreenBtn = document.getElementById("fullscreenBtn");
            const fullscreenModal = document.getElementById("fullscreenModal");
            const fullscreenImage = document.getElementById("fullscreenImage");
            const closeBtn = document.getElementById("closeFullscreen");
            const prevBtn = document.getElementById("prevImage");
            const nextBtn = document.getElementById("nextImage");
            const mainImage = document.getElementById("mainImage");
            const lens = document.getElementById("zoomLens");

            // Gallery images (backend integration)
            let galleryImages = [mainImage.src]; // default main image
            @if ($product->gallery)
                galleryImages = @json(array_merge([$product->main_image], json_decode($product->gallery, true)));
            @endif

            let currentIndex = 0;
            let imgReady = false;
            let ZOOM = 2.5;
            const LENS_R = lens.offsetWidth / 2;

            // ====== Fullscreen controls ======
            fullscreenBtn.addEventListener("click", () => {
                currentIndex = galleryImages.indexOf(mainImage.src);
                fullscreenImage.src = galleryImages[currentIndex];
                fullscreenModal.classList.add("show");
            });

            closeBtn.addEventListener("click", () => {
                fullscreenModal.classList.remove("show");
                lens.classList.add("hidden");
            });

            fullscreenModal.addEventListener("click", (e) => {
                if (e.target === fullscreenModal) {
                    fullscreenModal.classList.remove("show");
                    lens.classList.add("hidden");
                }
            });

            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape") {
                    fullscreenModal.classList.remove("show");
                    lens.classList.add("hidden");
                }
            });

            function showImage(index) {
                currentIndex = (index + galleryImages.length) % galleryImages.length;
                imgReady = false;
                fullscreenImage.src = galleryImages[currentIndex];
                fullscreenImage.addEventListener("load", markReady, {
                    once: true
                });
            }

            nextBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                showImage(currentIndex + 1);
            });

            prevBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                showImage(currentIndex - 1);
            });

            window.changeMainImage = (el, src) => {
                mainImage.src = src;
                currentIndex = galleryImages.indexOf(src);
            };

            // ====== Zoom Lens integration ======
            function getCoverFit() {
                const cw = fullscreenModal.clientWidth;
                const ch = fullscreenModal.clientHeight;
                const iw = fullscreenImage.naturalWidth;
                const ih = fullscreenImage.naturalHeight;

                const scale = Math.max(cw / iw, ch / ih);
                const displayW = iw * scale;
                const displayH = ih * scale;
                const offsetX = (cw - displayW) / 2;
                const offsetY = (ch - displayH) / 2;

                return {
                    cw,
                    ch,
                    iw,
                    ih,
                    scale,
                    displayW,
                    displayH,
                    offsetX,
                    offsetY
                };
            }

            function showLens() {
                if (!imgReady) return;
                lens.style.backgroundImage = `url('${fullscreenImage.src}')`;
                lens.style.backgroundSize =
                    `${fullscreenImage.naturalWidth * ZOOM}px ${fullscreenImage.naturalHeight * ZOOM}px`;
                lens.classList.remove("hidden");
            }

            function hideLens() {
                lens.classList.add("hidden");
            }

            function moveLensFromEvent(e) {
                if (!imgReady) return;
                const fit = getCoverFit();
                const rect = fullscreenImage.getBoundingClientRect();

                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                let x = clientX - rect.left;
                let y = clientY - rect.top;

                x = Math.max(LENS_R, Math.min(fit.cw - LENS_R, x));
                y = Math.max(LENS_R, Math.min(fit.ch - LENS_R, y));

                lens.style.left = `${x - LENS_R}px`;
                lens.style.top = `${y - LENS_R}px`;

                const imgX = (x - fit.offsetX) / fit.scale;
                const imgY = (y - fit.offsetY) / fit.scale;

                const bgPosX = -(imgX * ZOOM - LENS_R);
                const bgPosY = -(imgY * ZOOM - LENS_R);

                lens.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
                lens.style.backgroundSize =
                    `${fullscreenImage.naturalWidth * ZOOM}px ${fullscreenImage.naturalHeight * ZOOM}px`;
            }

            fullscreenImage.addEventListener("mouseenter", showLens);
            fullscreenImage.addEventListener("mouseleave", hideLens);
            fullscreenImage.addEventListener("mousemove", moveLensFromEvent);

            fullscreenImage.addEventListener("touchstart", (e) => {
                showLens();
                moveLensFromEvent(e);
            }, {
                passive: true
            });
            fullscreenImage.addEventListener("touchmove", (e) => moveLensFromEvent(e), {
                passive: true
            });
            fullscreenImage.addEventListener("touchend", hideLens);

            function markReady() {
                imgReady = true;
                lens.style.backgroundImage = `url('${fullscreenImage.src}')`;
                lens.style.backgroundSize =
                    `${fullscreenImage.naturalWidth * ZOOM}px ${fullscreenImage.naturalHeight * ZOOM}px`;
            }

            if (fullscreenImage.complete && fullscreenImage.naturalWidth) {
                markReady();
            } else {
                fullscreenImage.addEventListener("load", markReady, {
                    once: true
                });
            }
        });











        document.addEventListener("DOMContentLoaded", function() {
            let productId = "{{ $product->id }}";
            let shown = localStorage.getItem("review_shown_" + productId);

            if (!shown) {
                setTimeout(function() {
                    document.getElementById("review-modal-wrapper").classList.remove("hidden");
                    localStorage.setItem("review_shown_" + productId, "true");
                }, 8000); // 8 seconds delay
            }
        });

        function closeReviewModal() {
            document.getElementById("review-modal-wrapper").classList.add("hidden");
        }
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("review-form");
            if (!form) return;

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                // Clear old errors
                document.querySelectorAll(".error-message").forEach(el => el.textContent = "");

                let formData = new FormData(form);

                fetch(form.action, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.errors) {
                            // Show field errors
                            Object.keys(data.errors).forEach(field => {
                                let errorEl = document.querySelector(
                                    `[data-error-for="${field}"]`);
                                if (errorEl) {
                                    errorEl.textContent = data.errors[field][0];
                                }
                            });
                        } else if (data.success) {
                            // Append review instantly
                            const reviewList = document.getElementById("reviews-list");
                            if (reviewList) {
                                reviewList.insertAdjacentHTML("afterbegin", `
                        <div class="border p-4 rounded-lg mb-3">
                            <p class="font-semibold">⭐ ${data.review.rating}</p>
                            <p>${data.review.comment}</p>
                            <small class="text-gray-500">Just now</small>
                        </div>
                    `);
                            }

                            // Success message (custom toast style)
                            showToast("Review submitted successfully!");

                            // Reset form
                            form.reset();

                            // Close modal
                            closeReviewModal();
                        }
                    })
                    .catch(() => {
                        showToast("Something went wrong. Please try again.", "error");
                    });
            });
        });

        // Simple toast
        function showToast(message, type = "success") {
            let toast = document.createElement("div");
            toast.textContent = message;
            toast.className = `fixed top-5 right-5 px-4 py-2 rounded-lg shadow-lg text-white z-50
        ${type === "success" ? "bg-green-600" : "bg-red-600"}`;
            document.body.appendChild(toast);

            setTimeout(() => toast.remove(), 3000);
        }
        // Image Gallery Functions
        function changeMainImage(thumbnail, imageSrc) {
            // Remove active state from all thumbnails
            document.querySelectorAll(".thumbnail-btn").forEach((btn) => {
                btn.classList.remove("active", "border-accent");
                btn.classList.add("border-transparent");
            });

            // Add active state to clicked thumbnail
            thumbnail.classList.add("active", "border-accent");
            thumbnail.classList.remove("border-transparent");

            // Change main image
            document.getElementById("mainImage").src = imageSrc;
        }

        // Tab Functions
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll(".tab-content").forEach((content) => {
                content.classList.add("hidden");
            });

            // Remove active state from all tabs
            document.querySelectorAll(".tab-btn").forEach((btn) => {
                btn.classList.remove("active", "border-accent", "text-accent");
                btn.classList.add("border-transparent", "text-secondary-600");
            });

            // Show selected tab content
            document.getElementById(tabName).classList.remove("hidden");

            // Add active state to clicked tab
            event.target.classList.add("active", "border-accent", "text-accent");
            event.target.classList.remove(
                "border-transparent",
                "text-secondary-600"
            );
        }



        // Mobile responsiveness - Sticky cart button for mobile
        function createMobileCartButton() {
            if (window.innerWidth <= 768) {
                const existingMobileBtn = document.getElementById("mobile-cart-btn");
                if (!existingMobileBtn) {
                    const mobileCartBtn = document.createElement("div");
                    mobileCartBtn.id = "mobile-cart-btn";
                    mobileCartBtn.className =
                        "fixed bottom-4 left-4 right-4 bg-accent text-white rounded-lg p-4 shadow-modal z-40 md:hidden";
                    mobileCartBtn.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-semibold">$149.99</div>
                                <div class="text-body-sm opacity-90">Premium Wireless Earbuds Pro</div>
                            </div>
                            <button class="bg-white text-accent px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-fast">
                                Add to Cart
                            </button>
                        </div>
                    `;
                    document.body.appendChild(mobileCartBtn);

                    // Add click handler
                    mobileCartBtn
                        .querySelector("button")
                        .addEventListener("click", function() {
                            showToast(
                                "Added to Cart!",
                                "Premium Wireless Earbuds Pro has been added to your cart.",
                                "success"
                            );
                        });
                }
            } else {
                const existingMobileBtn = document.getElementById("mobile-cart-btn");
                if (existingMobileBtn) {
                    existingMobileBtn.remove();
                }
            }
        }

        // Initialize mobile cart button
        createMobileCartButton();
        window.addEventListener("resize", createMobileCartButton);





        document.getElementById("enquiryForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let form = this;
            let submitBtn = form.querySelector(".btn-primary");
            let btnText = submitBtn.innerHTML;

            // Clear previous inline errors
            form.querySelectorAll('.error-message').forEach(span => span.innerHTML = '');

            // Show loader
            submitBtn.innerHTML = "Sending... <span class='spinner'></span>";
            submitBtn.disabled = true;

            let formData = new FormData(form);

            fetch("{{ route('enquiries.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(async res => {
                    let data = await res.json();

                    submitBtn.innerHTML = btnText;
                    submitBtn.disabled = false;

                    if (res.ok && data.success) {
                        const toast2 = document.getElementById("toast2");
                        if (toast2) {
                            toast2.classList.remove("hidden");
                            setTimeout(() => toast2.classList.add("hidden"), 3000);
                        }
                        form.reset(); // reset form
                    } else if (res.status === 422) {
                        for (let field in data.errors) {
                            let input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                let errorSpan = input.closest('div').querySelector('.error-message');
                                if (errorSpan) errorSpan.innerHTML = data.errors[field][0];
                            }
                        }
                        showToast('Please fix the errors below.', 'error');
                    } else {
                        showToast('Something went wrong. Please try again!', 'error');
                    }
                })
                .catch(err => {
                    submitBtn.innerHTML = btnText;
                    submitBtn.disabled = false;
                    showToast('Server error occurred!', 'error');
                });
        });

        function showToast(message, type = 'success') {
            const toast = document.getElementById("toast2");
            const span = toast.querySelector('span');
            span.innerHTML = message;

            // Set color
            if (type === 'success') {
                const toast2 = document.getElementById("toast2");
                if (toast2) {
                    toast2.classList.remove("hidden");
                    setTimeout(() => toast2.classList.add("hidden"), 3000);
                }
            } else {
                toast.classList.remove('bg-green-600');
                toast.classList.add('bg-red-600');
            }

            // Show & slide in
            toast.classList.remove('hidden', 'translate-x-full');
            toast.classList.add('translate-x-0', 'opacity-100');

            // Hide after 4s
            setTimeout(() => {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.classList.add('hidden'), 500);
            }, 4000);
        }



        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.querySelector('select[name="filter"]');
            const sortSelect = document.querySelector('select[name="sort"]');
            const reviewsList = document.getElementById('reviews-list');
            const spinner = document.getElementById('reviews-spinner');

            function fetchReviews() {
                const filter = filterSelect.value === 'All Reviews' ? 'all' : filterSelect.value[0];
                const sort = sortSelect.value.replace(/\s+/g, '').toLowerCase();

                spinner.classList.remove('hidden');

                fetch(`{{ url('/products/' . $product->id . '/reviews') }}?filter=${filter}&sort=${sort}`)
                    .then(res => res.json())
                    .then(data => {
                        reviewsList.innerHTML = data.html;
                    })
                    .finally(() => {
                        spinner.classList.add('hidden');
                    });
            }

            filterSelect.addEventListener('change', fetchReviews);
            sortSelect.addEventListener('change', fetchReviews);
        });



        new Swiper(".related-swiper", {
            slidesPerView: 1,
            spaceBetween: 16,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
        });

        //update the quantity
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".decreaseQty").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const input = btn.parentElement.querySelector(".quantityValue");
                    const min = parseInt(input.min) || 1;
                    let current = parseInt(input.value);

                    if (current > min) {
                        input.value = current - 1;
                    }
                });
            });

            document.querySelectorAll(".increaseQty").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const input = btn.parentElement.querySelector(".quantityValue");
                    const max = parseInt(input.max) || 999;
                    let current = parseInt(input.value);

                    if (current < max) {
                        input.value = current + 1;
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            const loginWarningModalWrapper = document.getElementById("login-warning-modal-wrapper");
            const loginWarningModalWrapper2 = document.getElementById("login-warning-modal-wrapper2");
            const qtyInput = document.getElementById("quantityValue");

            // ✅ Add to Wishlist
            window.addToWishlist = function(productId) {
                fetch(`/wishlist/add`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => {
                        if (response.status === 401) {
                            loginWarningModalWrapper.classList.remove("hidden");
                            return null;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return;
                        if (data.status === "success") {
                            showToast(data.message, "success");
                            updateWishlistCount(data.count);
                        } else {
                            showToast(data.message, "info");
                        }
                    })
                    .catch(() => showToast("Something went wrong. Try again.", "error"));
            };

            // ✅ Add to Cart
            window.addToCart = function(productId) {
                const quantity = parseInt(qtyInput.value) || 1;

                fetch(`/product-view/cart/add`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => {
                        if (response.status === 401) {
                            loginWarningModalWrapper2.classList.remove("hidden");
                            return null;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return;
                        if (data.status === "success") {
                            updateCartCount(data.cartCount);
                            showToast(data.message, "success");
                        } else {
                            showToast(data.message, "error");
                        }
                    })
                    .catch(() => showToast("Failed to add to cart.", "error"));
            };

            // ✅ Helpers
            function updateWishlistCount(count) {
                const wishlistCountSpan = document.getElementById("wishlist-count");
                if (wishlistCountSpan) wishlistCountSpan.textContent = count;
            }

            function updateCartCount(count) {
                const cartCountSpan = document.getElementById("cart-count");
                if (cartCountSpan) cartCountSpan.textContent = count;
            }

            function showToast(message, type = "success") {
                const toastWrapper = document.getElementById("toast");
                const toastMessage = toastWrapper.querySelector(".toast-message");
                const textSpan = document.getElementById("toast-text");

                textSpan.textContent = message;
                toastMessage.classList.remove("bg-green-500", "bg-red-500", "bg-blue-500");
                if (type === "success") toastMessage.classList.add("bg-green-500");
                if (type === "error") toastMessage.classList.add("bg-red-500");
                if (type === "info") toastMessage.classList.add("bg-blue-500");

                toastWrapper.classList.remove("hidden");
                toastMessage.classList.remove("opacity-0", "scale-95");
                toastMessage.classList.add("opacity-100", "scale-100");

                setTimeout(() => {
                    toastMessage.classList.remove("opacity-100", "scale-100");
                    toastMessage.classList.add("opacity-0", "scale-95");
                    setTimeout(() => toastWrapper.classList.add("hidden"), 300);
                }, 3000);
            }

            // ✅ Modal helpers
            window.goToSignIn = function() {
                window.location.href = "{{ route('login') }}";
            };
            window.continueBrowsing = function() {
                loginWarningModalWrapper.classList.add("hidden");
                loginWarningModalWrapper2.classList.add("hidden");
            };
        });


        document.querySelectorAll('#starRating .star').forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                document.getElementById('ratingValue').value = value;

                // Highlight stars up to clicked one
                document.querySelectorAll('#starRating .star').forEach(s => {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                });
                for (let i = 0; i < value; i++) {
                    document.querySelectorAll('#starRating .star')[i].classList.add('text-yellow-400');
                    document.querySelectorAll('#starRating .star')[i].classList.remove('text-gray-300');
                }
            });
        });

        function showToastComment(message, type = "success") {
            const toast = document.getElementById("toast-comment");

            if (!toast) return;

            // Reset styles
            toast.classList.remove("bg-green-600", "bg-red-600", "bg-blue-600", "hidden");

            // Change color depending on type
            if (type === "success") {
                toast.classList.add("bg-green-600");
            } else if (type === "error") {
                toast.classList.add("bg-red-600");
            } else {
                toast.classList.add("bg-blue-600");
            }

            // Set message
            toast.querySelector("span").innerText = message;

            // Show toast
            toast.classList.remove("hidden");

            // Auto-hide after 3 seconds
            setTimeout(() => {
                toast.classList.add("hidden");
            }, 3000);
        }
        document.getElementById("reviewForm").addEventListener("submit", function(e) {
            e.preventDefault(); // stop normal form submit

            const form = e.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: formData
                })
                .then(response => {
                    if (response.status === 401) {
                        loginWarningModalWrapper.classList.remove("hidden");
                        return null;
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data) return;

                    if (data.success) {
                        showToastComment(data.message, "success");

                        // reset form after success
                        form.reset();
                        document.querySelectorAll("#starRating .star").forEach(star => {
                            star.classList.remove("text-yellow-400");
                            star.classList.add("text-gray-300");
                        });
                    } else {
                        showToastComment(data.message ?? "Failed to submit review.", "error");
                    }
                })
                .catch(() => showToastComment("Something went wrong. Try again.", "error"));
        });

        "use strict";

// * step 1
const cartBadeg = document.querySelector(".cart .badge");
if (
  localStorage.getItem("productNum") &&
  +JSON.parse(localStorage.getItem("productNum")) != 0
) {
  cartBadeg.style.display = "inline";
  cartBadeg.textContent = JSON.parse(localStorage.getItem("productNum"));
}

// *step 2
const productImgs = document.querySelectorAll("main .pImg");
const currentImg = document.querySelector("main .currentImg img");
const prevBtn = document.querySelector("main .previous");
const nextBtn = document.querySelector("main .next");
let currentIndx = 0;

function getImg(indx, list, img) {
  if (currentIndx == list.length) {
    currentIndx = 0;
  } else if (currentIndx < 0) {
    currentIndx = list.length - 1;
  }
  img.src = list[currentIndx].src;
}

nextBtn.addEventListener("click", (e) => {
  getImg(currentIndx++, productImgs, currentImg);
});
prevBtn.addEventListener("click", (e) => {
  getImg(currentIndx--, productImgs, currentImg);
});

// *step 3
if (window.screen.width < 768) {
  const menuIcon = document.querySelector(".mobMenuIcon");
  const navMenu = document.querySelector(".navMenu");
  const header = document.querySelector("header");
  const mainSec = document.querySelector("main");

  navMenu.style.cssText = `left:-100%; top: ${header.clientHeight}px; min-height: calc(100vh - ${header.clientHeight}px)`;

  menuIcon.addEventListener("click", function (e) {
    if (this.classList.contains("closed")) {
      navMenu.style.cssText = `left:0%; top: ${header.clientHeight}px; min-height: calc(100vh - ${header.clientHeight}px)`;
      mainSec.style.display = "none";
      this.classList.toggle("closed");
    } else {
      navMenu.style.cssText = `left:-100%; top: ${header.clientHeight}px; min-height: calc(100vh - ${header.clientHeight}px)`;
      mainSec.style.display = "block";
      this.classList.toggle("closed");
    }
  });
} else {
  let imgIndex = 0;
  // ! functions declarations
  function hideLayers(secLayer) {
    secLayer.forEach((layer) => {
      layer.style.display = "none";
    });
  }

  function displayImg(list, secLayer, current) {
    list.forEach((img, indx) => {
      img.addEventListener("click", (e) => {
        current.src = img.src;
        imgIndex = indx;
        hideLayers(secLayer);
        secLayer[indx].style.display = "block";
      });
    });
  }

  // *step 4
  const layers = document.querySelectorAll(" main .otherImgs .layer");

  hideLayers(layers);
  layers[0].style.display = "block";

  displayImg(productImgs, layers, currentImg);

  // *step 5
  const lightBox = document.querySelector(".lightBox");
  const imgSec = document.querySelector(".lightBox .productImgs");
  const boxCurrentImg = document.querySelector(".lightBox .currentImg img");
  const boxImgs = document.querySelectorAll(".lightBox .boxImg ");
  const boxLayers = document.querySelectorAll(".lightBox .otherImgs .layer");
  const nextLightBtn = document.querySelector(".lightBox .next");
  const prevLightBtn = document.querySelector(".lightBox .previous");

  // ^ a. show & hide lightBox
  currentImg.addEventListener("click", (e) => {
    lightBox.style.display = "flex";
    boxCurrentImg.src = currentImg.src;
    currentIndx = imgIndex; //& to be used in displaying the corresponding boxLayer when clicking on next & prev btns
    hideLayers(boxLayers);
    boxLayers[imgIndex].style.display = "block";
    displayImg(boxImgs, boxLayers, boxCurrentImg);
  });

  lightBox.addEventListener("click", (e) => {
    lightBox.style.display = "none";
  });

  imgSec.addEventListener("click", (e) => {
    // & to not close the lighBox when user clicks on imgSec
    e.stopPropagation();
  });

  // ^ b. lightBox functionality
  nextLightBtn.addEventListener("click", (e) => {
    getImg(currentIndx++, boxImgs, boxCurrentImg);
    // & to display a layer on the currently active img only
    hideLayers(boxLayers);
    boxLayers[currentIndx].style.display = "block";
  });
  prevLightBtn.addEventListener("click", (e) => {
    getImg(currentIndx--, boxImgs, boxCurrentImg);
    // & to display a layer on the currently active img only
    hideLayers(boxLayers);
    boxLayers[currentIndx].style.display = "block";
  });
}

//* step 6
const addToCartBtn = document.querySelector(".addToCart");
const productNum = document.querySelector(".cartInfo .num");
const PlusBtn = document.querySelector(".cartInfo .plus");
const minusBtn = document.querySelector(".cartInfo .minus");
const alertPar = document.querySelector(".alert");

PlusBtn.addEventListener("click", (e) => {
  if (+productNum.textContent < 5) {
    productNum.textContent = +productNum.textContent + 1;
  } else {
    alertPar.textContent = `The maximum number you can add is 5`;
  }
});

minusBtn.addEventListener("click", (e) => {
  productNum.textContent = +productNum.textContent - 1;
  alertPar.textContent = ``;
  if (+productNum.textContent <= 0) {
    productNum.textContent = `0`;
  }
});

addToCartBtn.addEventListener("click", (e) => {
  cartBadeg.style.display = "inline";
  cartBadeg.textContent = productNum.textContent;
  localStorage.setItem("productNum", JSON.stringify(productNum.textContent));
});
    </script>
@endsection
