import React from 'react'

import FeatureCard from './feature-card'
import Question1 from './question1'
import projectStyles from '.style.module.css'
import styles from './home.module.css'

const Home = (props) => {
  return (
    <div className={styles['container']}>
      <div className={styles['header']}>
        <header
          data-thq="thq-navbar"
          className={` ${projectStyles['navbar-container']} ${styles['navbar-interactive']} `}
        >
          <span className={projectStyles['logo']}>RENTAL</span>
          <div data-thq="thq-navbar-nav" className={styles['desktop-menu']}>
            <nav className={styles['links']}>
              <span className={projectStyles['body-small']}>Home</span>
              <span
                className={` ${styles['nav22']} ${projectStyles['body-small']} `}
              >
                Cars
              </span>
              <span
                className={` ${styles['nav32']} ${projectStyles['body-small']} `}
              >
                Locations
              </span>
              <span
                className={` ${styles['nav42']} ${projectStyles['body-small']} `}
              >
                Contact
              </span>
            </nav>
            <div className={styles['buttons']}>
              <button
                className={` ${styles['login']} ${projectStyles['button-flat']} `}
              >
                Login
              </button>
              <button className={projectStyles['button-filled']}>
                Register
              </button>
            </div>
          </div>
          <div data-thq="thq-burger-menu" className={styles['burger-menu']}>
            <svg
              viewBox="0 0 1024 1024"
              className={` ${styles['icon']} ${projectStyles['social-icons']} `}
            >
              <path d="M128 554.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 298.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 810.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"></path>
            </svg>
          </div>
          <div
            data-thq="thq-mobile-menu"
            className={` ${styles['mobile-menu1']} ${projectStyles['mobile-menu']} `}
          >
            <div className={styles['nav']}>
              <div className={styles['top']}>
                <span className={projectStyles['logo']}>RENTAL</span>
                <div data-thq="thq-close-menu" className={styles['close-menu']}>
                  <svg
                    viewBox="0 0 1024 1024"
                    className={` ${styles['icon02']} ${projectStyles['social-icons']} `}
                  >
                    <path d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"></path>
                  </svg>
                </div>
              </div>
              <nav className={styles['links1']}>
                <span
                  className={` ${styles['nav121']} ${projectStyles['body-small']} `}
                >
                  Home
                </span>
                <span
                  className={` ${styles['nav221']} ${projectStyles['body-small']} `}
                >
                  Cars
                </span>
                <span
                  className={` ${styles['nav321']} ${projectStyles['body-small']} `}
                >
                  Locations
                </span>
                <span
                  className={` ${styles['nav421']} ${projectStyles['body-small']} `}
                >
                  Contact
                </span>
              </nav>
              <div className={styles['buttons1']}>
                <button className={projectStyles['button-flat']}>Login</button>
                <button className={projectStyles['button-filled']}>
                  Register
                </button>
              </div>
            </div>
            <div>
              <svg
                viewBox="0 0 950.8571428571428 1024"
                className={` ${styles['icon04']} ${projectStyles['social-icons']} `}
              >
                <path d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"></path>
              </svg>
              <svg
                viewBox="0 0 877.7142857142857 1024"
                className={` ${styles['icon06']} ${projectStyles['social-icons']} `}
              >
                <path d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"></path>
              </svg>
              <svg
                viewBox="0 0 602.2582857142856 1024"
                className={` ${styles['icon08']} ${projectStyles['social-icons']} `}
              >
                <path d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"></path>
              </svg>
            </div>
          </div>
        </header>
      </div>
      <div className={styles['hero']}>
        <div
          className={` ${projectStyles['hero-container']} ${styles['hero1']} `}
        >
          <div className={styles['container01']}>
            <h1
              className={` ${styles['hero-heading']} ${projectStyles['heading1']} `}
            >
              Explore the World with Our Car Rental Service
            </h1>
            <span
              className={` ${styles['hero-sub-heading']} ${projectStyles['body-large']} `}
            >
              <span>
                <span>
                  <span>Rent a car hassle-free with EasyRide Rentals</span>
                  <span>
                    <span
                      dangerouslySetInnerHTML={{
                        __html: ' ',
                      }}
                    />
                  </span>
                </span>
                <span>
                  <span>
                    <span
                      dangerouslySetInnerHTML={{
                        __html: ' ',
                      }}
                    />
                  </span>
                  <span>
                    <span
                      dangerouslySetInnerHTML={{
                        __html: ' ',
                      }}
                    />
                  </span>
                </span>
              </span>
              <span>
                <span>
                  <span>
                    <span
                      dangerouslySetInnerHTML={{
                        __html: ' ',
                      }}
                    />
                  </span>
                  <span>
                    <span
                      dangerouslySetInnerHTML={{
                        __html: ' ',
                      }}
                    />
                  </span>
                </span>
                <span>
                  <span>
                    <span
                      dangerouslySetInnerHTML={{
                        __html: ' ',
                      }}
                    />
                  </span>
                  <span>
                    <span
                      dangerouslySetInnerHTML={{
                        __html: ' ',
                      }}
                    />
                  </span>
                </span>
              </span>
            </span>
            <div className={styles['btn-group']}>
              <button className={projectStyles['button-filled']}>
                Book Now
              </button>
              <button className={projectStyles['button-flat']}>
                Learn More →
              </button>
            </div>
          </div>
        </div>
      </div>
      <div className={styles['features']}>
        <div className={projectStyles['features-container']}>
          <div className={styles['features1']}>
            <div className={styles['container02']}>
              <span className={projectStyles['overline']}>
                <span>features</span>
                <br></br>
              </span>
              <h2
                className={` ${styles['features-heading']} ${projectStyles['heading2']} `}
              >
                Explore Our Features
              </h2>
              <span
                className={` ${styles['features-sub-heading']} ${projectStyles['body-large']} `}
              >
                <span>
                  <span>
                    <span>
                      Discover what sets us apart in the car rental industry
                    </span>
                    <span>
                      <span
                        dangerouslySetInnerHTML={{
                          __html: ' ',
                        }}
                      />
                    </span>
                  </span>
                  <span>
                    <span>
                      <span
                        dangerouslySetInnerHTML={{
                          __html: ' ',
                        }}
                      />
                    </span>
                    <span>
                      <span
                        dangerouslySetInnerHTML={{
                          __html: ' ',
                        }}
                      />
                    </span>
                  </span>
                </span>
                <span>
                  <span>
                    <span>
                      <span
                        dangerouslySetInnerHTML={{
                          __html: ' ',
                        }}
                      />
                    </span>
                    <span>
                      <span
                        dangerouslySetInnerHTML={{
                          __html: ' ',
                        }}
                      />
                    </span>
                  </span>
                  <span>
                    <span>
                      <span
                        dangerouslySetInnerHTML={{
                          __html: ' ',
                        }}
                      />
                    </span>
                    <span>
                      <span
                        dangerouslySetInnerHTML={{
                          __html: ' ',
                        }}
                      />
                    </span>
                  </span>
                </span>
              </span>
            </div>
            <div className={styles['container03']}>
              <FeatureCard
                heading="Wide Selection of Vehicles"
                subHeading="Choose from a variety of cars, SUVs, and trucks to suit your needs"
              ></FeatureCard>
              <FeatureCard
                heading="Easy Booking Process"
                subHeading="Simple and quick online booking system for your convenience"
              ></FeatureCard>
              <FeatureCard
                heading="Flexible Rental Options"
                subHeading="Daily, weekly, or monthly rental plans to fit your schedule"
              ></FeatureCard>
              <FeatureCard
                heading="24/7 Customer Support"
                subHeading="Dedicated customer service team available round the clock to assist you"
              ></FeatureCard>
            </div>
          </div>
        </div>
      </div>
      <div className={styles['pricing']}>
        <div className={projectStyles['pricing-container']}>
          <div className={styles['container04']}>
            <span className={projectStyles['overline']}>
              <span>Pricing</span>
              <br></br>
            </span>
            <h2 className={projectStyles['heading2']}>Choose Your Plan</h2>
            <span
              className={` ${styles['pricing-sub-heading']} ${projectStyles['body-large']} `}
            >
              <span>
                <span>
                  Find the perfect plan that suits your needs and budget
                </span>
              </span>
            </span>
          </div>
          <div className={styles['container05']}>
            <div
              className={` ${projectStyles['free-pricing-card']} ${styles['pricing-card']} `}
            >
              <div className={styles['container06']}>
                <span
                  className={` ${styles['text36']} ${projectStyles['heading3']} `}
                >
                  Free
                </span>
                <span className={projectStyles['body-small']}>
                  Ideal for occasional drivers
                </span>
              </div>
              <div className={styles['container07']}>
                <span className={styles['text37']}>
                  <span>$</span>
                  <span></span>
                </span>
                <span className={styles['free-plan-price']}>0</span>
              </div>
              <div className={styles['container08']}>
                <div className={styles['container09']}>
                  <span className={styles['text40']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Limited mileage
                  </span>
                </div>
                <div className={styles['container10']}>
                  <span className={styles['text41']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Basic insurance included
                  </span>
                </div>
                <div className={styles['container11']}>
                  <span className={styles['text42']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    24/7 roadside assistance
                  </span>
                </div>
                <div className={styles['container12']}>
                  <span className={styles['text43']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    No hidden fees
                  </span>
                </div>
              </div>
              <button
                className={` ${styles['button']} ${projectStyles['button-outline']} `}
              >
                Continue with Free
              </button>
            </div>
            <div
              className={` ${projectStyles['basic-pricing-card']} ${styles['pricing-card1']} `}
            >
              <div className={styles['container13']}>
                <span
                  className={` ${styles['text44']} ${projectStyles['heading3']} `}
                >
                  BASIC
                </span>
                <span className={projectStyles['body-small']}>
                  Great for regular drivers
                </span>
              </div>
              <div className={styles['container14']}>
                <span className={styles['text45']}>
                  <span>$</span>
                  <span></span>
                </span>
                <span className={styles['basic-plan-pricing']}>50</span>
                <span className={styles['text48']}>/ month</span>
              </div>
              <div className={styles['container15']}>
                <div className={styles['container16']}>
                  <span className={styles['text49']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    All features of FREE plan
                  </span>
                </div>
                <div className={styles['container17']}>
                  <span className={styles['text51']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Unlimited mileage
                  </span>
                </div>
                <div className={styles['container18']}>
                  <span className={styles['text52']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Comprehensive insurance
                  </span>
                </div>
                <div className={styles['container19']}>
                  <span className={styles['text53']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Additional driver option
                  </span>
                </div>
                <div className={styles['container20']}>
                  <span className={styles['text54']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Flexible booking changes
                  </span>
                </div>
              </div>
              <button
                className={` ${styles['button1']} ${projectStyles['button-filled-secondary']} `}
              >
                Try the Basic plan
              </button>
            </div>
            <div
              className={` ${projectStyles['pro-pricing-card']} ${styles['pricing-card2']} `}
            >
              <div className={styles['container21']}>
                <span
                  className={` ${styles['text55']} ${projectStyles['heading3']} `}
                >
                  <span>PRO</span>
                  <br></br>
                </span>
                <span className={projectStyles['body-small']}>
                  Perfect for frequent travelers
                </span>
              </div>
              <div className={styles['container22']}>
                <span className={styles['text58']}>
                  <span>$</span>
                  <span></span>
                </span>
                <span className={styles['pro-plan-pricing']}>100</span>
                <span className={styles['text61']}>/ month</span>
              </div>
              <div className={styles['container23']}>
                <div className={styles['container24']}>
                  <span className={styles['text62']}>✔</span>
                  <span className={projectStyles['body-small']}>
                     All features of BASIC plan
                  </span>
                </div>
                <div className={styles['container25']}>
                  <span className={styles['text64']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Premium vehicle selection
                  </span>
                </div>
                <div className={styles['container26']}>
                  <span className={styles['text65']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    VIP customer support
                  </span>
                </div>
                <div className={styles['container27']}>
                  <span className={styles['text66']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Free GPS navigation
                  </span>
                </div>
                <div className={styles['container28']}>
                  <span className={styles['text67']}>✔</span>
                  <span className={projectStyles['body-small']}>
                    Priority booking
                  </span>
                </div>
              </div>
              <button
                className={` ${styles['button2']} ${projectStyles['button-filled-secondary']} `}
              >
                Try the PRO plan
              </button>
            </div>
          </div>
        </div>
      </div>
      <div className={styles['banner']}>
        <div
          className={` ${projectStyles['banner-container']} ${styles['banner1']} `}
        >
          <h1
            className={` ${styles['banner-heading']} ${projectStyles['heading2']} `}
          >
            Convenient and Affordable Car Rentals
          </h1>
          <span
            className={` ${styles['banner-sub-heading']} ${projectStyles['body-small']} `}
          >
            <span>
              <span>
                <span>
                  EasyRide Rentals offers a wide range of vehicles to suit your
                  needs, whether you&apos;re traveling for business or pleasure.
                  With competitive prices and excellent customer service, we
                  make renting a car simple and stress-free. Choose from our
                  diverse fleet and start your journey with EasyRide Rentals
                  today.
                </span>
                <span>
                  <span
                    dangerouslySetInnerHTML={{
                      __html: ' ',
                    }}
                  />
                </span>
              </span>
              <span>
                <span>
                  <span
                    dangerouslySetInnerHTML={{
                      __html: ' ',
                    }}
                  />
                </span>
                <span>
                  <span
                    dangerouslySetInnerHTML={{
                      __html: ' ',
                    }}
                  />
                </span>
              </span>
            </span>
            <span>
              <span>
                <span>
                  <span
                    dangerouslySetInnerHTML={{
                      __html: ' ',
                    }}
                  />
                </span>
                <span>
                  <span
                    dangerouslySetInnerHTML={{
                      __html: ' ',
                    }}
                  />
                </span>
              </span>
              <span>
                <span>
                  <span
                    dangerouslySetInnerHTML={{
                      __html: ' ',
                    }}
                  />
                </span>
                <span>
                  <span
                    dangerouslySetInnerHTML={{
                      __html: ' ',
                    }}
                  />
                </span>
              </span>
            </span>
          </span>
          <button className={projectStyles['button-filled']}>Learn More</button>
        </div>
      </div>
      <div className={styles['faq']}>
        <div className={projectStyles['faq-container']}>
          <div className={styles['faq1']}>
            <div className={styles['container29']}>
              <span className={projectStyles['overline']}>
                <span>FAQ</span>
                <br></br>
              </span>
              <h2
                className={` ${styles['text85']} ${projectStyles['heading2']} `}
              >
                Common questions
              </h2>
              <span
                className={` ${styles['text86']} ${projectStyles['body-large']} `}
              >
                <span>
                  Here are some of the most common questions that we get.
                </span>
                <br></br>
              </span>
            </div>
            <div className={styles['container30']}>
              <Question1
                answer="You will need a valid driver's license, a credit card in the renter's name, and be at least 21 years old."
                question="What do I need to rent a car?"
              ></Question1>
              <Question1
                answer="Yes, additional drivers can be added to the rental agreement for an extra fee, provided they meet the age and license requirements."
                question="Can I add an additional driver to my rental?"
              ></Question1>
              <Question1
                answer="Most of our rental cars come with a full-to-full fuel policy, where you receive the car with a full tank and are expected to return it with a full tank."
                question="What is the fuel policy for the rental cars?"
              ></Question1>
              <Question1
                answer="The minimum rental period is typically 24 hours, but this may vary depending on the location and type of vehicle."
                question="Is there a minimum rental period?"
              ></Question1>
              <Question1
                answer="Late returns may incur additional charges. Please contact our customer service for assistance if you anticipate returning the car late."
                question="What happens if I return the car late?"
              ></Question1>
            </div>
          </div>
        </div>
      </div>
      <div className={styles['footer']}>
        <footer
          className={` ${projectStyles['footer-container']} ${styles['footer1']} `}
        >
          <div className={styles['container31']}>
            <span className={projectStyles['logo']}>RENTAL</span>
            <nav className={styles['nav1']}>
              <span className={projectStyles['body-small']}>Home</span>
              <span
                className={` ${styles['nav222']} ${projectStyles['body-small']} `}
              >
                Cars
              </span>
              <span
                className={` ${styles['nav322']} ${projectStyles['body-small']} `}
              >
                Locations
              </span>
              <span
                className={` ${styles['nav422']} ${projectStyles['body-small']} `}
              >
                Contact
              </span>
            </nav>
          </div>
          <div className={styles['separator']}></div>
          <div className={styles['container32']}>
            <span
              className={` ${projectStyles['body-small']} ${styles['text89']} `}
            >
              © 2023 myCompany, All Rights Reserved.
            </span>
            <div className={styles['icon-group1']}>
              <svg
                viewBox="0 0 950.8571428571428 1024"
                className={` ${styles['icon10']} ${projectStyles['social-icons']} `}
              >
                <path d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"></path>
              </svg>
              <svg
                viewBox="0 0 877.7142857142857 1024"
                className={` ${styles['icon12']} ${projectStyles['social-icons']} `}
              >
                <path d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"></path>
              </svg>
              <svg
                viewBox="0 0 602.2582857142856 1024"
                className={` ${styles['icon14']} ${projectStyles['social-icons']} `}
              >
                <path d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"></path>
              </svg>
            </div>
          </div>
        </footer>
      </div>
    </div>
  )
}

export default Home
