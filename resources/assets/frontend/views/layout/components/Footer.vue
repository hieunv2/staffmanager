<template>
  <div id="footer" ref="footer">
    <div class="container">
      <ElRow :gutter="20">
        <ElCol :span="8" class="footer-left">
          <a href="">
          </a>
          <ul>
            <li>
              <a href="">
                <img src="@/frontend/assets/footer/img1_20.png" alt="">
              </a>
            </li>
            <li>
              <a href="">
                <img src="@/frontend/assets/footer/img1_28.png" alt="">
              </a>
            </li>
            <li>
              <a href="">
                <img src="@/frontend/assets/footer/img1_22.png" alt="">
              </a>
            </li>
            <li>
              <a href="">
                <img src="@/frontend/assets/footer/img1_24.png" alt="">
              </a>
            </li>
          </ul>
        </ElCol>
        <ElCol :span="8" class="footer-center">
          <h4>Hanoi head office</h4>
          <ul>
            <li>
              <strong><img src="@/frontend/assets/footer/img1_06.png" alt=""></strong>
              <span>
                R. 606, 6F, IPH Bldg, 241 Xuan Thuy, Dich <br>
                Vong Hau, Cau Giay District, Ha Noi, Viet Nam
              </span>
            </li>
            <li>
              <strong><img src="@/frontend/assets/footer/img1_13.png" alt=""></strong>
              <span>
                +8424 6296 6162
              </span>
            </li>
            <li>
              <strong><img src="@/frontend/assets/footer/img1_26.png" alt=""></strong>
              <span>
                info@bcon.vn
              </span>
            </li>
          </ul>
        </ElCol>
        <ElCol :span="8" class="footer-right">
          <h4>HCMC representative office</h4>
          <ul>
            <li>
              <strong><img src="@/frontend/assets/footer/img1_06.png" alt=""></strong>
              <span>
                R. 18, PSO Serviced Office, 15F, LIM II Bldg, 62A <br>
                Cach Mang Thang Tam, Ward 6, Dist 3, HCMC
              </span>
            </li>
            <li>
              <strong><img src="@/frontend/assets/footer/img1_13.png" alt=""></strong>
              <span>
                +8428 7109 9727
              </span>
            </li>
          </ul>
        </ElCol>
      </ElRow>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Footer',
  data() {
    return {
      menus: [
        { title: 'Welcome', path: 'welcome' },
        { title: 'Who are we', path: 'who' },
        { title: 'What we do', path: 'what' },
        { title: 'Who we partner with', path: 'partner' }
      ]
    }
  },
}
</script>

<style lang="scss">
  @import "@/frontend/styles/variables.scss";
  #footer{
    padding-top: 20px;
    padding-bottom: 20px;
    font-size: 12px;
    >.container {
      width: 1100px;
    }
    &.down {
      visibility: visible;
      opacity: 1;
    }
      background: $basicBlue;
      color: #fff;
      a {
        color: #fff;
        :hover {
          color: white;
        }
      }
      h4{
        position: relative;
        font-weight: 400;
        text-transform: uppercase;
        margin-bottom: 0px;
        &:before{
          content: '';
          position: absolute;
          top: 20px;
          left: 0px;
          width: 100%;
          height: 1px;
          background: orange;
        }
      }
      ul{
        list-style: none;
        padding-left: 0px;
        margin-top: 17px;
        li{
          display: flex;
          align-items: baseline;
          padding-bottom: 5px;
          strong{
            width: 25px;
            text-align: center;
          }
          span{
            position: relative;
            top: -3px;
            font-size: 12px;
          }
        }
      }
      .footer-left{
        ul{
          padding-left: 10px;
          margin-top: 0px;
          li{
            display: inline-block;
            width: 40px;
          }
        }
      }
    .footer-center{
      padding-left: 30px;
    }
      .footer-right{
        padding-left: 30px;
        h4{
          position: relative;
          font-weight: 400;
        }
      }
    }
</style>
