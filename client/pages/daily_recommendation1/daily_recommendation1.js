// pages/index/home_page.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    imgclick:0,
    changeclick:0,
    sentence:'',
    sentence1: '',
    sentence2: '',
    source:'',
    source1:'',
    source2:''
  },
  chooseThis:function () {
    var that = this;
    var imgclick = that.data.imgclick === 0 ? 1 : 0;
    that.setData({
      imgclick: imgclick
    });
  },
  changethis:function(){
    var that=this;
    if(that.data.changeclick===0){
      that.setData({
        changeclick: 1
      });
      wx.request({
        url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_day_list', //仅为示例，并非真实的接口地址
        data: {
          daynum: getApp().globalData.onum[1]
        },
        header: {
          'content-type': 'application/json' // 默认值
        },
        success: res => {
          console.log(res.data),
            this.setData({
              sentence1: res.data[0].sentence_content,
              source1: res.data[0].sentence_source
            })
        }
      })
    }
    else if (that.data.changeclick === 1) {
      that.setData({
        changeclick: 2
      });
      wx.request({
        url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_day_list', //仅为示例，并非真实的接口地址
        data: {
          daynum: getApp().globalData.onum[2]
        },
        header: {
          'content-type': 'application/json' // 默认值
        },
        success: res => {
          console.log(res.data),
            res.data[0].sentence_source == null ? '' : res.data[0].sentence_source,
            this.setData({
              sentence2: res.data[0].sentence_content,
              source2: res.data[0].sentence_source
            })
        }
      })
    }
    else if (that.data.changeclick === 2) {
      that.setData({
        changeclick: 0
      });
      wx.request({
        url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_day_list', //仅为示例，并非真实的接口地址
        data: {
          daynum: getApp().globalData.onum[0]
        },
        header: {
          'content-type': 'application/json' // 默认值
        },
        success: res => {
          console.log(res.data),
            this.setData({
            sentence: res.data[0].sentence_content,
            source: res.data[0].sentence_source
            })
        }
      })
    };
    // that.setData({
    //   changeclick: changeclick
    // });
  },
  sentencenum:function(){
    wx.request({
      url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_daily_list', //仅为示例，并非真实的接口地址
      header: {
        'content-type': 'application/json' // 默认值
      },
      success: res => {
        console.log(res.data);
        var arr = [];

        for (var i = 1; i <= res.data; i++) {
          arr.push(i);
        }

        arr.sort(
          function () {
            return 0.5 - Math.random();
          }
        );

        arr.length=3;
        getApp().globalData.onum = arr;
        wx.request({
        url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_day_list', //仅为示例，并非真实的接口地址
        data: {
          daynum: getApp().globalData.onum[0]
        },
        header: {
          'content-type': 'application/json' // 默认值
        },
        success: res => {
          console.log(res.data),
            this.setData({
              sentence: res.data[0].sentence_content,
              source: res.data[0].sentence_source
            })
        }
      })
      }
    })
    // return onum;
  },
  // changesentence:function(){
  //   $rownum=this.sentencenum();

  // },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
   this.sentencenum();
   console.log(getApp().globalData.onum);
  //  wx.request({
  //    url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_day_list', //仅为示例，并非真实的接口地址
  //    data: {
  //      daynum: getApp().globalData.onum[0]
  //    },
  //    header: {
  //      'content-type': 'application/json' // 默认值
  //    },
  //    success: res => {
  //      console.log(res.data),
  //        this.setData({
  //          sentence: res.data
  //        })
  //    }
  //  })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})