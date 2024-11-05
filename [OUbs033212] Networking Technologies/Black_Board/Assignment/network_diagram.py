from diagrams import Diagram, Cluster
from diagrams.aws.network import VPC
from diagrams.onprem.network import Internet
from diagrams.generic.network import Firewall, Subnet

# Create the network diagram
with Diagram("Three Branch Network", show=False):

    # Branch 1 Router and Firewall
    with Cluster("Branch 1"):
        router_b1 = Internet("Branch1 Router")
        firewall_b1 = Firewall("Branch1 Firewall")

        with Cluster("Departments"):
            accounts_b1 = Subnet("Accounts VLAN (59 hosts)")
            admin_b1 = Subnet("Admin VLAN (69 hosts)")
            marketing_b1 = Subnet("Marketing VLAN (119 hosts)")
            sales_b1 = Subnet("Sales VLAN (249 hosts)")

        router_b1 >> firewall_b1 >> [accounts_b1, admin_b1, marketing_b1, sales_b1]

    # Branch 2 Router and Firewall
    with Cluster("Branch 2"):
        router_b2 = Internet("Branch2 Router")
        firewall_b2 = Firewall("Branch2 Firewall")

        with Cluster("Departments"):
            accounts_b2 = Subnet("Accounts VLAN (59 hosts)")
            admin_b2 = Subnet("Admin VLAN (69 hosts)")
            marketing_b2 = Subnet("Marketing VLAN (119 hosts)")
            sales_b2 = Subnet("Sales VLAN (249 hosts)")

        router_b2 >> firewall_b2 >> [accounts_b2, admin_b2, marketing_b2, sales_b2]

    # Branch 3 Router and Firewall
    with Cluster("Branch 3"):
        router_b3 = Internet("Branch3 Router")
        firewall_b3 = Firewall("Branch3 Firewall")

        with Cluster("Departments"):
            accounts_b3 = Subnet("Accounts VLAN (59 hosts)")
            admin_b3 = Subnet("Admin VLAN (69 hosts)")
            marketing_b3 = Subnet("Marketing VLAN (119 hosts)")
            sales_b3 = Subnet("Sales VLAN (249 hosts)")

        router_b3 >> firewall_b3 >> [accounts_b3, admin_b3, marketing_b3, sales_b3]

    # Connect Branch Routers
    router_b1 - router_b2 - router_b3
