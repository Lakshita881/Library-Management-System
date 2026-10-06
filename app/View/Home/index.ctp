<div class="library-home">

    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">
            LibraryHub
        </div>

        <div class="nav-links">
            <?php
            echo $this->Html->link(
                'Home',
                array('controller' => 'home', 'action' => 'index')
            );

            echo $this->Html->link(
                'Books',
                array('controller' => 'books', 'action' => 'index')
            );

            echo $this->Html->link(
                'Login',
                array('controller' => 'members', 'action' => 'login'),
                array('class' => 'login-btn')
            );
            ?>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero">

        <div class="hero-content">

            <p class="small-title">WELCOME TO LIBRARYHUB</p>

            <h1>
                Discover Your Next
                <span>Great Read</span>
            </h1>

            <p class="hero-text">
                Explore our collection of books, discover new authors,
                and manage your library experience in one place.
            </p>

            <div class="hero-buttons">

                <?php
                echo $this->Html->link(
                    'Explore Books',
                    array(
                        'controller' => 'members',
                        'action' => 'ViewBooks'
                    ),
                    array('class' => 'primary-btn')
                );

                echo $this->Html->link(
                    'Create Account',
                    array(
                        'controller' => 'members',
                        'action' => 'register'
                    ),
                    array('class' => 'secondary-btn')
                );
                ?>

            </div>

        </div>

        <div class="hero-card">

            <div class="book-icon">📚</div>

            <h3>Your Library</h3>

            <p>
                Manage books, members and borrowing
                from one simple platform.
            </p>

            <!-- <div class="card-line"></div>

            <div class="card-info">
                <span>Books</span>
                <strong>Explore →</strong>
            </div> -->

        </div>

    </section>


    <!-- Features -->
    <section class="features">

        <div class="section-heading">
            <p>LIBRARY SERVICES</p>
            <h2>Everything You Need</h2>
        </div>

        <div class="feature-grid">

            <div class="feature-card">
                <div class="feature-icon">📖</div>
                <h3>Browse Books</h3>
                <p>
                    Search and explore books available
                    in our library collection.
                </p>

                <?php
                echo $this->Html->link(
                    'View Books →',
                    array(
                        'controller' => 'members',
                        'action' => 'ViewBooks'
                    )
                );
                ?>
            </div>


            <div class="feature-card">
                <div class="feature-icon">👤</div>
                <h3>Become a Member</h3>
                <p>
                    Create your account and become a
                    member of our library.
                </p>

                <?php
                echo $this->Html->link(
                    'Register →',
                    array(
                        'controller' => 'members',
                        'action' => 'register'
                    )
                );
                ?>
            </div>


            <div class="feature-card">
                <div class="feature-icon">🔖</div>
                <h3>Borrow Books</h3>
                <p>
                    Keep track of your borrowed books,
                    due dates and returns.
                </p>

                <?php
                echo $this->Html->link(
                    'Login →',
                    array(
                        'controller' => 'members',
                        'action' => 'login'
                    )
                );


                
                ?>
            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="footer">

        <div>
            <h3>LibraryHub</h3>
            <p>
                Making reading and library management simple.
            </p>
        </div>

        <div>
            <p>© <?php echo date('Y'); ?> LibraryHub</p>
        </div>

    </footer>

</div>